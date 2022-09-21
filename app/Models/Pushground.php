<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Pushground extends Model
{
	use HasFactory;
	
	private int    $providerId;
	private string $url;
	private string $apiKey;
	private string $email;
	private string $password;
	
	public function __construct()
	{
		$this->providerId = env('API_PUSHGROUND_PROVIDER_ID');
		$this->url        = env('API_PUSHGROUND_URL');
		$this->apiKey     = env('API_PUSHGROUND_APIKEY');
		$this->email      = env('API_PUSHGROUND_EMAIL');
		$this->password   = env('API_PUSHGROUND_PASSWORD');
	}
	
	
	/**
	 * It gets all the campaigns, then loops through them and gets the stats for each campaign
	 *
	 * @param startDate The date you want to get the metrics for.
	 *
	 * @return array An array of campaign stats.
	 */
	public function getMetrics($startDate): array
	{
		$campaigns = $this->getAllCampaigns()->object();
		
		$campaignStats = [];
		
		foreach ($campaigns as $i => $campaign) {
			$stats = Http::withHeaders([
				'Authorization' => $this->apiKey,
			])->withOptions([
				'verify' => false
			])->get($this->url . "/advertisers/stats/?dateStart=" . $startDate . "&dateEnd=" . $startDate . "&dimensions=campaign&campaigns=" . $campaign->id . "&timeZone=UTC")->object();
			
			if ($stats === null) continue;
			
			$campaignStats[ $campaign->id ] = [
				'name'    => $campaign->name,
				'metrics' => $stats->total->metrics,
			];
		}
		
		return $campaignStats;
	}
	
	/**
	 * It creates an API key for the user.
	 *
	 * @return An array with the key and the token.
	 */
	public function createApiKey()
	{
		return Http::withOptions([
			'verify' => false
		])->post($this->url . '/advertisers/key', [
			'email'    => $this->email,
			'password' => $this->password,
		])->json();
	}
	
	/**
	 * It gets all the campaigns from the advertiser.
	 *
	 * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response array of all campaigns.
	 */
	public function getAllCampaigns(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
	{
		return Http::withHeaders([
			'Authorization' => $this->apiKey,
		])->withOptions([
			'verify' => false
		])->get($this->url . '/advertisers/campaigns');
	}
	
	public function downloadInfo($date = null)
	{
		if (isset($_GET[ 'date' ])) {
			$date = $_GET[ 'date' ];
		} else {
			if (is_null($date))
				$date = date('Y-m-d', strtotime('yesterday'));
		}
		
		//GET Dates
		$dateTable = date("Ymd", strtotime($date));
		$convTable = "conv_log_storage_" . $dateTable;
		
		$startDate = date('Y-m-d', strtotime($date));
		
		//GET All campaigns
		$url               = $this->url . "advertisers/campaigns";
		$campaignsResponse = $this->request($url);
		if (!$campaignsResponse) {
//			echo 'No campaignsResponse';
			return 1;
		}
		
		$campaigns = array();
		foreach ($campaignsResponse as $key => $campaign) {
			$campaigns[ $campaign->id ][ "pushgroundId" ]   = $campaign->id;
			$campaigns[ $campaign->id ][ "pushgroundName" ] = $campaign->name;
		}
		
		//GET CampaignStats single campaign request
		foreach ($campaigns as $pid => $values) {
			$url              = $this->url . "advertisers/stats/?dateStart=" . $startDate . "&dateEnd=" . $startDate . "&dimensions=campaign&campaigns=" . $pid . "&timeZone=UTC";
			$apiCampaignStats = $this->request($url);
			if (!$apiCampaignStats) {
//				echo 'No CampaignStats for pushground campaignId';
				continue;
			}
			
			if (isset($campaigns[ $apiCampaignStats->leafs[ 0 ]->dimensions->campaign ])) {
				$campaigns[ $apiCampaignStats->leafs[ 0 ]->dimensions->campaign ][ "cost" ]       = $apiCampaignStats->leafs[ 0 ]->metrics->cost;
				$campaigns[ $apiCampaignStats->leafs[ 0 ]->dimensions->campaign ][ "clicks" ]     = $apiCampaignStats->leafs[ 0 ]->metrics->clicks;
				$campaigns[ $apiCampaignStats->leafs[ 0 ]->dimensions->campaign ][ "deliveries" ] = $apiCampaignStats->leafs[ 0 ]->metrics->deliveries;
			}
		}
		
		//Save CampaignStats
		foreach ($campaigns as $cid => $campaignData) {
			if (!isset($campaignData[ "clicks" ])) { // if no clicks dismiss campaign
				continue;
			}
			$campaignID = Utilities::parseCampaignID($campaignData[ "pushgroundName" ]);
			
			if (!$campaignID) {
//				echo "Invalid external campaign name: '" . $campaignData[ "pushgroundName" ];
				continue;
			}
			
			$criteria = new CDbCriteria;
			$criteria->compare('campaigns_id', $campaignID);
			$criteria->compare('providers_id', $this->providerId);
			$criteria->compare('date', $date);
			
			if (DailyReport::model()->exists($criteria))
				$dailyReport = DailyReport::model()->find($criteria);
			else
				$dailyReport = new DailyReport();
			
			$dailyReport->campaigns_id = $campaignID;
			$dailyReport->date         = $date;
			$dailyReport->providers_id = $this->providerId;
			$dailyReport->imp          = $campaignData[ "deliveries" ];
			$dailyReport->clics        = $campaignData[ "clicks" ];
			$dailyReport->spend        = round($campaignData[ "cost" ], 3);
			
			$criteriaConv = new CDbCriteria;
			$criteriaConv->compare('t.campaign_id', $campaignID);
			$criteriaConv->select = array('COUNT(t.id) as convs');
			$conv_report          = ConvLogToday::forTable($convTable)->find($criteriaConv);
			$convs                = $conv_report->convs;
			
			$dailyReport->conv_api = $convs ? $convs : 0;
			$dailyReport->updateRevenue();
			$dailyReport->setNewFields();
			if (!$dailyReport->save()) {
				Yii::log("Can't save campaign: '" . $campaignData[ "pushgroundName" ] . "message error: " . json_encode($dailyReport->getErrors()), 'error', 'system.model.api.pushground');
				continue;
			}
		}
		
		Yii::log("SUCCESS - Daily info downloaded", 'info', 'system.model.pushground');
		return 0;
		
	}
}
