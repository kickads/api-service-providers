<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\V1\DailyReportByIdtRequest;
use App\Http\Resources\V1\DailyReportCollection;
use App\Http\Resources\V1\DailyReportResource;
use App\Models\DailyReport;
use Exception;
use Illuminate\Http\JsonResponse;
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
	 * @param Request $request
	 * @return DailyReportResource|JsonResponse
	 */
	public function show(Request $request)
	{
		try {
			
			if (!DailyReport::find($request->id)) throw new Exception('El registro no existe en la base de datos');
			
			return new DailyReportResource(DailyReport::find($request->id));
			
		} catch (Exception $e) {
			return response()->json([
				'status' => 'Error',
				'msj'    => $e->getMessage()
			]);
		}
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
	 * @param Request $request
	 * @return DailyReportResource|JsonResponse
	 */
	public function destroy(Request $request)
	{
		try {
			
			if (!$res = DailyReport::find($request->id)) throw new Exception('El registro no existe en la base de datos');
			
			$res->delete();
			
			return new DailyReportResource($request);
			
		} catch (Exception $e) {
			return response()->json([
				'status' => 'Error',
				'msj'    => $e->getMessage()
			]);
		}
	}
}