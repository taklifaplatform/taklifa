<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\CheckEmailExistsController;
use Modules\Auth\Http\Controllers\LoginController;
use Modules\Auth\Http\Controllers\RegisterController;
use Modules\Auth\Http\Controllers\ResetPasswordController;
use Modules\Auth\Http\Controllers\VerifyEmailController;
use Modules\Auth\Http\Controllers\VerifyPhoneNumberController;

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

Route::prefix('auth')->group(static function (): void {
    Route::post('register', [RegisterController::class, 'store']);
    Route::post('login', [LoginController::class, 'store']);
    Route::post('logout', [LoginController::class, 'destroy']);
    Route::prefix('verify')->group(static function (): void {
        Route::post('email/verify', [VerifyEmailController::class, 'verifyEmail']);
        Route::post('email/send-verification', [VerifyEmailController::class, 'sendEmailVerification']);
        Route::post('phone-number/verify', [VerifyPhoneNumberController::class, 'verifyPhoneNumber']);
        Route::post('phone-number/send-verification', [VerifyPhoneNumberController::class, 'sendPhoneNumberVerification']);
    });
    Route::prefix('reset-password')->group(static function (): void {
        Route::post('request', [ResetPasswordController::class, 'sendResetPasswordPinCode']);
        Route::post('check', [ResetPasswordController::class, 'verifyResetPasswordPinCode']);
        Route::post('change', [ResetPasswordController::class, 'resetPassword']);
    });
    Route::post('check-email-exists', [CheckEmailExistsController::class, 'checkEmailExists']);
});
