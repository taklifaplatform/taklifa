<?php

use Illuminate\Support\Facades\Route;
use Modules\UserVerification\Http\Controllers\UserVerificationController;

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

Route::middleware('auth:sanctum')->prefix('verification')->group(static function (): void {
    Route::get('user', [UserVerificationController::class, 'show']);
    Route::post('user', [UserVerificationController::class, 'storeUserVerification']);
    Route::post('driver', [UserVerificationController::class, 'storeDriverVerification']);
});
