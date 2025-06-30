<?php

use Illuminate\Support\Facades\Route;
use Modules\Vehicle\Http\Controllers\VehicleController;
use Modules\Vehicle\Http\Controllers\VehicleModelController;

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
    Route::get('/manager/vehicles', [VehicleController::class, 'fetchAllVehicles']);
    Route::get('/manager/vehicles/{vehicle}', [VehicleController::class, 'retrieveVehicle']);
    Route::post('/manager/vehicles', [VehicleController::class, 'createVehicle']);
    Route::put('/manager/vehicles/{vehicle}', [VehicleController::class, 'updateVehicle']);
    Route::delete('/manager/vehicles/{vehicle}', [VehicleController::class, 'deleteVehicle']);
});
Route::get('/vehicle-models', [VehicleModelController::class, 'list']);
