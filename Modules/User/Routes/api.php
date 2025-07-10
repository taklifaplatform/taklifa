<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\PublicUsersController;
use Modules\User\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->prefix('auth')->group(static function (): void {
    Route::get('user', [UserController::class, 'retrieveUser']);
    Route::put('user', [UserController::class, 'update']);
    Route::post('user/update-password', [UserController::class, 'updatePassword']);
    Route::post('user/update-email', [UserController::class, 'updateEmail']);
    Route::post('user/update-phone-number', [UserController::class, 'updatePhoneNumber']);
    Route::post('user/update-location', [UserController::class, 'updateLocation']);
    Route::post('user/change-active-role', [UserController::class, 'changeActiveRole']);
    Route::delete('user/delete-account', [UserController::class, 'deleteAccount']);
    Route::post('user/enable-customer-role', [UserController::class, 'enableCustomerRole']);
});

Route::middleware('auth:sanctum')->prefix('users')->group(function () {
    Route::get('/', [PublicUsersController::class, 'fetchAllUsers']);
    Route::get('/{user}', [PublicUsersController::class, 'retrieveUser']);
});
