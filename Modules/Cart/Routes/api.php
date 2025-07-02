<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Cart\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Cart API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your cart module.
|
*/

// Cart endpoints - Authentication is optional and handled in controller
Route::prefix('cart')->group(function () {
    // Get cart items
    Route::get('{company_id}/{identifier}/items', [CartController::class, 'getCartItems']);
});

Route::middleware('auth:sanctum')->prefix('/cart')->group(static function (): void {
    Route::post('{company_id}/{identifier}/items', [CartController::class, 'addCartItem']);
    Route::get('{company_id}/{identifier}', [CartController::class, 'getOrCreateCart']);
});

