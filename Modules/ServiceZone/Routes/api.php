<?php

use Illuminate\Support\Facades\Route;
use Modules\ServiceZone\Http\Controllers\ServiceZoneController;

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

Route::middleware(['auth:sanctum'])->group(static function (): void {
    Route::get('/service-zones', [ServiceZoneController::class, 'fetchAllZoneServices']);
    Route::get('/service-zones/{serviceZone}', [ServiceZoneController::class, 'retrieveZoneService']);
    Route::post('/service-zones', [ServiceZoneController::class, 'createZoneService']);
    Route::put('/service-zones/{serviceZone}', [ServiceZoneController::class, 'updateZoneService']);
    Route::delete('/service-zones/{serviceZone}', [ServiceZoneController::class, 'deleteZoneService']);
});
