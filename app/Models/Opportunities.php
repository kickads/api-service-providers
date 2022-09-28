<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunities extends Model
{
	use HasFactory;
	
	public function campaigns()
	{
		return $this->hasMany(Campaigns::class, 'opportunities_id', 'id');
	}
	
	public function deals()
	{
		return $this->belongsTo(Deals::class, 'deals_id');
	}
	
	public function ios()
	{
		return $this->belongsTo(Ios::class, 'ios_id');
	}
}
