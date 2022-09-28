<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
	use HasFactory;
	
	protected $fillable = ['clics', 'imp', 'spend', 'date', 'providers_id'];
	
	protected $collection = "daily_report";
	protected $table      = "daily_report";
	public    $timestamps = false;
	
	/**
	 * [updateRevenue description]
	 * @param  [type] $custom_rate [description]
	 * @return [type]              [description]
	 */
	public function updateRevenue($custom_rate = NULL)
	{
		try {
			$c    = Campaigns::findOrFail($this->campaigns_id);
			$opp  = Opportunities::findOrFail($c->opportunities_id);
			$deal = Deals::findOrFail($opp->deals_id);
			
			$agency_fee = $deal->agency_fee;
			if (!is_null($agency_fee)) {
				$this->revenue = $this->spend * (1 + $agency_fee / 100);
				return;
			}
			
			// update revenue for single rate
			$rate = $custom_rate == NULL ? $opp->getRate($this->date) : $custom_rate;
			switch ($opp->model_adv) {
				case 'CPM':
					$this->revenue = $this->imp_adv != NULL ? $this->imp_adv * $rate / 1000 : $this->imp * $rate / 1000;
					break;
				case 'CPC':
					$this->revenue = $this->clics_adv != NULL ? $this->clics_adv * $rate : $this->clics * $rate;
					break;
				case 'CPI':
					$this->revenue = $this->installs != NULL ? $this->installs * $rate : 0;
					break;
				case 'CPV':
				case 'CPA':
				case 'CPL':
					$this->revenue = $this->conv_adv != NULL ? $this->conv_adv * $rate : $this->conv_api * $rate;
					break;
			}
		} catch (\Exception $e) {
			var_dump($e->getMessage());
		}
	}
	
	/**
	 * [setNewFields description]
	 */
	public function setNewFields()
	{
		$this->profit             = $this->getProfit();
		$this->profit_percent     = $this->getProfitPerc();
		$this->click_through_rate = $this->getCtr();
		$this->conversion_rate    = $this->getConvRate();
		$this->eCPM               = $this->getECPM();
		$this->eCPC               = $this->getECPC();
		$this->eCPA               = $this->getECPA();
	}
	
	/**
	 * [getECPM description]
	 * @return [type] [description]
	 */
	public function getECPM()
	{
		$imp = $this->imp_adv == 0 ? $this->imp : $this->imp_adv;
		$r   = $imp == 0 ? 0 : round($this->getSpendUSD() * 1000 / $imp, 2);
		return $r;
	}
	
	/**
	 * [getECPC description]
	 * @return [type] [description]
	 */
	public function getECPC()
	{
		$clics = $this->getClics();
		$r     = $clics == 0 ? 0 : round($this->getSpendUSD() / $clics, 2);
		return $r;
	}
	
	/**
	 * [getECPA description]
	 * @return [type] [description]
	 */
	public function getECPA()
	{
		$conv = $this->getConv();
		$r    = $conv == 0 ? 0 : round($this->getSpendUSD() / $conv, 2);
		return $r;
	}
	
	/**
	 * [getConvRate description]
	 * @return [type] [description]
	 */
	public function getConvRate()
	{
		$conv  = $this->getConv();
		$clics = $this->getClics();
		$r     = $clics == 0 ? 0 : round($conv / $clics, 4);
		return $r;
	}
	
	/**
	 * [getClics description]
	 * @return [type] [description]
	 */
	public function getClics()
	{
		return $this->clics_adv == null ? $this->clics : $this->clics_adv;
	}
	
	/**
	 * [getConv description]
	 * @return [type] [description]
	 */
	public function getConv()
	{
		return $this->conv_adv == null ? $this->conv_api : $this->conv_adv;
	}
	
	/**
	 * [getImp description]
	 * @return [type] [description]
	 */
	public function getImp()
	{
		return $this->imp_adv == null ? $this->imp : $this->imp_adv;
	}
	
	/**
	 * [getProfitPerc description]
	 * @return [type] [description]
	 */
	public function getProfitPerc()
	{
		try {
			$c          = Campaigns::findOrFail($this->campaigns_id);
			$opp        = Opportunities::findOrFail($c->opportunities_id);
			$deal       = Deals::findOrFail($opp->deals_id);
			$agency_fee = $deal->agency_fee;
			
			if (!is_null($agency_fee)) {
				return $agency_fee / 100;
			}
			
			$revenue = $this->getRevenueUSD(true);
			$r       = $revenue == 0 ? 0 : round($this->getProfit() / $revenue, 2);
			return $r;
		} catch (\Exception $e) {
			var_dump($e->getMessage());
		}
	}
	
	/**
	 * [getCtr description]
	 * @return [type] [description]
	 */
	public function getCtr()
	{
		$imp   = $this->imp_adv == 0 ? $this->imp : $this->imp_adv;
		$clics = $this->getClics();
		$r     = $imp == 0 ? 0 : round($clics / $imp, 4);
		return $r;
	}
	
	/**
	 * [getProfit description]
	 * @return [type] [description]
	 */
	public function getProfit()
	{
		return round($this->getRevenueUSD(true) - $this->getSpendUSD(), 2);
	}
	
	/**
	 * [getRevenueUSD description]
	 * @return [type] [description]
	 */
	public function getRevenueUSD($withRetentions = false)
	{
		$camp         = Campaigns::findOrFail($this->campaigns_id);
		$ios_currency = $camp->opportunities->ios->currency;
		
		$ret               = 1;
		$agency_commission = 1;
		if ($withRetentions) {
			if ($camp->opportunities->ios->ret != NULL)
				$ret = (1 - $camp->opportunities->ios->ret / 100);
			
			if ($camp->opportunities->agency_commission)
				$agency_commission = (1 - $camp->opportunities->agency_commission / 100);
		}
		
		if ($ios_currency == 'USD') // if currency is USD dont apply type change
			return $this->revenue * $ret * $agency_commission;
		
		$currency = new Currency;
		$currency = $currency->findByDate($this->date);
		return $currency ? round($this->revenue * $ret * $agency_commission / $currency[ $ios_currency ], 2) : 'Currency ERROR!';
	}
	
	/**
	 * [getSpendUSD description]
	 * @return [type] [description]
	 */
	public function getSpendUSD()
	{
		$net_currency = Providers::findOrFail($this->providers_id)->currency;
		
		if ($net_currency == 'USD') // if currency is USD dont apply type change
			return $this->spend + $this->cost_adserving;
		
		$currency = new Currency;
		$currency = $currency->findByDate($this->date);
		return $currency ? round($this->spend / $currency[ $net_currency ], 2) : 'Currency ERROR!';
	}
}