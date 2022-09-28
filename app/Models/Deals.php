<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deals extends Model
{
	use HasFactory;
	
	public function opportunities()
	{
		return $this->hasMany(Opportunities::class, 'deals_id', 'id');
	}
	
	public function advertisers()
	{
		return $this->belongsTo(Advertisers::class, 'advertisers_id');
	}
}
