<?php

use Illuminate\Support\Facades\Route;
use Modules\Services\Http\Controllers\ServicesController;
use Modules\Services\Http\Controllers\ManageServiceController;
use Modules\Services\Http\Controllers\ServiceCategoriesController;

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
Route::prefix('/Services')->group(static function (): void {
    // Public endpoints services
    Route::get('/', [ServicesController::class, 'listServices']);
    Route::get('/{Service}', [ServicesController::class, 'retrieveService']);
});

/**
 * Service Categories endpoints
 */
Route::prefix('/Service-categories')->group(static function (): void {
    // Public endpoints services
    Route::get('/', [ServiceCategoriesController::class, 'listServiceCategories']);
});


Route::middleware('auth:sanctum')->prefix('/Services')->group(static function (): void {
    Route::post('/', [ManageServiceController::class, 'createService']);
    Route::put('/{Service}', [ManageServiceController::class, 'updateService']);
    Route::delete('/{Service}', [ManageServiceController::class, 'deleteService']);
});
