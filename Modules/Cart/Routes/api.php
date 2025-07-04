<?php

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

// Cart endpoints
Route::prefix('cart')->group(function () {
    // Public cart routes (no authentication required)
    Route::get('{company_id}/{identifier}/items', [CartController::class, 'getCartItems']);

    // Authenticated cart routes (optional authentication)
    Route::middleware('auth:sanctum')->group(function () {
        // Get or create cart (with user association if authenticated)
        Route::get('{company_id}/{identifier}', [CartController::class, 'getOrCreateCart']);

        // Add item to cart (with user association if authenticated)
        Route::post('{company_id}/{identifier}/items', [CartController::class, 'addCartItem']);
    });
});

