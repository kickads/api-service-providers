<?php

use App\Http\Controllers\Api\V1\DailyReportController;
use App\Http\Controllers\PushgroundController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

Route::controller(PushgroundController::class)->prefix('provider/pushground')->group(function () {
	Route::get('', 'index');
	Route::get('/apikey', 'createApiKey');
	Route::get('/metrics', 'getMetrics');
	Route::get('/saveMetrics', 'save');
});

Route::controller(DailyReportController::class)->prefix('dailyReport')->group(function () {
	Route::get('', 'index');
	Route::get('/{id}', 'show');
	Route::delete('/{id}', 'destroy');
});