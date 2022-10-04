<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\DailyReportCollection;
use App\Http\Resources\V1\DailyReportResource;
use App\Models\DailyReport;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class DailyReportController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return DailyReportCollection
	 */
	public function index()
	{
		return new DailyReportCollection(DailyReport::orderByDesc('id')->paginate(15));
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return AnonymousResourceCollection
	 */
	public function store(Request $request)
	{
	
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param DailyReport $dailyReport
	 * @return DailyReportResource
	 */
	public function show(DailyReport $dailyReport)
	{
		return new DailyReportResource($dailyReport);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
