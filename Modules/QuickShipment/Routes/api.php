<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\QuickShipment\Http\Controllers\QuickShipmentController;

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

Route::prefix('quick-shipments')->middleware('auth:sanctum')->group(function () {
    Route::get('/user', [QuickShipmentController::class, 'fetchUserShipments']);
    Route::get('/driver', [QuickShipmentController::class, 'fetchDriverShipments']);
    Route::get('/{quickShipment}', [QuickShipmentController::class, 'retrieveShipment']);
    Route::post('/', [QuickShipmentController::class, 'storeShipment']);
    Route::put('/{quickShipment}', [QuickShipmentController::class, 'updateShipment']);
    Route::put('/{quickShipment}/accept', [QuickShipmentController::class, 'acceptShipment']);
    Route::delete('/{quickShipment}', [QuickShipmentController::class, 'destroyShipment']);
});
