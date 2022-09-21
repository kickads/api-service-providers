<?php

namespace App\Http\Controllers;

use App\Models\Pushground;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiPushgroundController extends Controller
{
	/**
	 * It validates the date input, sets the date to yesterday if no date is provided, and then gets all campaigns from Pushground for that date
	 *
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function index(Request $request)
	{
		try {
			$request->validate([
				'date' => 'date_format:Y-m-d'
			]);
			
			$date = $request->date ?? date('Y-m-d', strtotime('yesterday'));
			
			$campaigns = (new Pushground)->getAllCampaigns($date)->json();
			
			return response()->json($campaigns);
			
		} catch (Exception $e) {
			return response()->json([
				'Exception' => $e->getMessage(),
				'File'      => $e->getFile(),
				'Line'      => $e->getLine(),
			]);
		}
	}
	

	/**
	 * It creates an API key and returns it as a JSON response
	 *
	 * @return JsonResponse response is a JSON object containing the API key.
	 */
	public function createApiKey()
	{
		try {
			$apikey = (new Pushground)->createApiKey();
			
			return response()->json($apikey);
			
		} catch (Exception $e) {
			return response()->json([
				'Exception' => $e->getMessage(),
				'File'      => $e->getFile(),
				'Line'      => $e->getLine(),
			]);
		}
	}
	
	/**
	 * It takes a date in the format of `Y-m-d` and returns the metrics for that date
	 *
	 * @param Request $request
	 * @return JsonResponse metrics for the date specified.
	 */
	public function getMetrics(Request $request)
	{
		try {
			$request->validate([
				'date' => 'date_format:Y-m-d'
			]);
			
			$date = $request->date ?? date('Y-m-d', strtotime('yesterday'));
			
			$metrics = (new Pushground)->getMetrics($date);
			
			return response()->json($metrics);
			
		} catch (Exception $e) {
			return response()->json([
				'Exception' => $e->getMessage(),
				'File'      => $e->getFile(),
				'Line'      => $e->getLine(),
			]);
		}
	}
	
}
