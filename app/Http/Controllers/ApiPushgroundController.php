<?php

namespace App\Http\Controllers;

use App\Models\Pushground;
use Illuminate\Http\Request;

class ApiPushgroundController extends Controller
{
	/**
	 * It validates the date input, sets the date to yesterday if no date is provided, and then gets all campaigns from Pushground for that date
	 *
	 * @param Request $request
	 */
	public function index(Request $request)
	{
		$request->validate([
			'date' => 'date_format:Y-m-d'
		]);
		
		$date = $request->date ?? date('Y-m-d', strtotime('yesterday'));
		
		$campaigns = (new Pushground)->getAllCampaigns($date);
		
		dd($campaigns->json());
	}
	
	/**
	 * It creates an API key.
	 */
	public function createApiKey()
	{
		$apikey = (new Pushground)->createApiKey();
		
		dd($apikey);
	}
	
	public function getMetrics(Request $request)
	{
		$request->validate([
			'date' => 'date_format:Y-m-d'
		]);
		
		$date = $request->date ?? date('Y-m-d', strtotime('yesterday'));
		
		(new Pushground)->getMetrics($date);
	}
}
