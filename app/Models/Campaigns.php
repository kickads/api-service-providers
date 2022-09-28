<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaigns extends Model
{
	use HasFactory;
	
	public function convs()
	{
		return $this->hasMany(ConvLogToday::class, 'campaign_id', 'id');
	}
	
	public function opportunities()
	{
		return $this->belongsTo(Opportunities::class, 'opportunities_id');
	}
}
