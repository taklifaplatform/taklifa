<?php

use Illuminate\Support\Facades\Route;
use Modules\Services\Http\Controllers\ServicesController;
use Modules\Services\Http\Controllers\ManageServiceController;

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

/**
 * Services endpoints
 */
Route::prefix('/services')->group(static function (): void {
    // Public endpoints services
    Route::get('/', [ServicesController::class, 'listServices']);
    Route::get('/companies/{company}/services', [ServicesController::class, 'listCompanyServices']);
    Route::get('/drivers/{driver}/services', [ServicesController::class, 'listDriverServices']);
    Route::get('/{service}', [ServicesController::class, 'retrieveZoneService']);
});

Route::middleware('auth:sanctum')->prefix('/services')->group(static function (): void {
    Route::post('/', [ManageServiceController::class, 'createService']);
    Route::put('/{service}', [ManageServiceController::class, 'updateService']);
    Route::delete('/{service}', [ManageServiceController::class, 'deleteService']);
});
