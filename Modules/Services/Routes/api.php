<?php

use Illuminate\Support\Facades\Route;
use Modules\Services\Http\Controllers\ServicesController;
use Modules\Services\Http\Controllers\ServiceCategoriesController;
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

Route::prefix('/services')->group(static function (): void {
    // Public endpoints services
    Route::get('/', [ServicesController::class, 'listServices']);
    Route::get('/{service}', [ServicesController::class, 'retrieveService']);
});

/**
 * Service Categories
 */
Route::prefix('/service-categories')->group(static function (): void {
    // Public endpoints services
    Route::get('/', [ServiceCategoriesController::class, 'listServiceCategories']);
});


Route::middleware('auth:sanctum')->prefix('/services')->group(static function (): void {
    Route::post('/', [ManageServiceController::class, 'createService']);
    Route::put('/{service}', [ManageServiceController::class, 'updateService']);
    Route::delete('/{service}', [ManageServiceController::class, 'deleteService']);
});
