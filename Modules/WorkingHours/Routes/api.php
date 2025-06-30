<?php

use Illuminate\Support\Facades\Route;
use Modules\WorkingHours\Http\Controllers\WorkingHoursController;

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

Route::prefix('working-hours')->group(function () {

    Route::get('{workingHour}', [WorkingHoursController::class, 'retrieve']);

    Route::middleware('auth:sanctum')->put('{workingHour}', [WorkingHoursController::class, 'update']);
});
