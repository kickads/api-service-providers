<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvLogToday extends Model
{
	use HasFactory;
	
	protected $collection = "conv_log_today";
	protected $table      = "conv_log_today";
	protected $fillable   = [
		'id', 'is_informed'
	
	];
	public    $timestamps = false;
	protected $primaryKey = 'id';
	
	public function campaigns()
	{
		return $this->belongsTo(Campaigns::class, 'campaign_id', 'id');
	}
	
	public static function getConversionsByCampaignAndDate($campaignId, $date)
	{
		return self::where('campaign_id', $campaignId)->whereDate('date', $date)->count();
	}
}
