<?php

use Illuminate\Support\Facades\Route;
use Modules\Job\Http\Controllers\JobsController;

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

Route::get('jobs', [JobsController::class, 'listJobs']);
Route::get('jobs/{job}', [JobsController::class, 'retrieveJob']);
