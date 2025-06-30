<?php

use Illuminate\Support\Facades\Route;
use Modules\Shipment\Http\Controllers\ShipmentController;
use Modules\Shipment\Http\Controllers\ShipmentContractController;
use Modules\Shipment\Http\Controllers\ShipmentProposalController;
use Modules\Shipment\Http\Controllers\ShipmentInvitationController;

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

// Shipment endpoints Public

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/shipment-filters', [ShipmentController::class, 'fetchShipmentFilters']);
    Route::get('/shipments', [ShipmentController::class, 'fetchAllShipment']);
    Route::post('/shipments', [ShipmentController::class, 'storeShipment']);
    Route::get('/shipments/{shipment}', [ShipmentController::class, 'retrieveShipment']);
    Route::put('/shipments/{shipment}', [ShipmentController::class, 'updateShipment']);
    Route::post('/shipments/{shipment}/confirm', [ShipmentController::class, 'confirmShipment']);
    Route::delete('/shipments/{shipment}', [ShipmentController::class, 'destroyShipment']);

    Route::prefix('shipments/{shipment}/invitations')->group(function () {
        Route::get('', [ShipmentInvitationController::class, 'fetchShipmentInvitations']);
        Route::get('permissions', [ShipmentInvitationController::class, 'getPermissions']);
        Route::get('{shipmentInvitation}', [ShipmentInvitationController::class, 'retrieveShipmentInvitation']);
        Route::post('{shipmentInvitation}/accept', [ShipmentInvitationController::class, 'acceptShipmentInvitation']);
        Route::post('{shipmentInvitation}/decline', [ShipmentInvitationController::class, 'declineShipmentInvitation']);
        Route::delete('{shipmentInvitation}', [ShipmentInvitationController::class, 'removeShipmentInvitation']);
    });

    Route::prefix('shipments/{shipment}/proposals')->group(function () {
        Route::get('', [ShipmentProposalController::class, 'fetchShipmentProposals']);
        Route::get('permissions', [ShipmentProposalController::class, 'getPermissions']);
        Route::get('{shipmentProposal}', [ShipmentProposalController::class, 'retrieveShipmentProposal']);
        Route::post('{shipmentProposal}/accept', [ShipmentProposalController::class, 'acceptShipmentProposal']);
        Route::post('{shipmentProposal}/decline', [ShipmentProposalController::class, 'declineShipmentProposal']);
        Route::put('{shipmentProposal}/edit', [ShipmentProposalController::class, 'editShipmentProposal']);
    });

    Route::post('shipments-proposals/{shipmentProposal}/create-contract', [ShipmentContractController::class, 'createProposalContract']);

    Route::prefix('shipment-contract')->group(function () {
        Route::get('{shipmentContract}', [ShipmentContractController::class, 'fetchShipmentContract']);
        Route::get('{shipmentContract}/permissions', [ShipmentContractController::class, 'getPermissions']);
        // delete Shipment Contract
        Route::delete('{shipmentContract}', [ShipmentContractController::class, 'cancelContract']);
    });
});

Route::get('/shipments-code/{code}', [ShipmentController::class, 'retrieveShipmentByCode']);