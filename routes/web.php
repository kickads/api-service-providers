<?php

use App\Http\Controllers\PushgroundController;
use App\Http\Controllers\ApiUpdateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//	return view('welcome');
//});

//Route::controller(PushgroundController::class)->prefix('/apiUpdate/pushground')->group(function () {
//	Route::get('', 'index');
//	Route::get('/apikey', 'createApiKey');
//	Route::get('/metrics', 'getMetrics');
//	Route::get('/saveMetrics', 'save');
//});