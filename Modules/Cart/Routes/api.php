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

// Cart endpoints
Route::prefix('cart')->group(function () {
    // Get or create cart by company_id and identifier
    Route::get('{company_id}/{identifier}', [CartController::class, 'getOrCreateCart']);
    
    // Get cart items
    Route::get('{company_id}/{identifier}/items', [CartController::class, 'getCartItems']);
    
    // Add item to cart
    Route::post('{company_id}/{identifier}/items', [CartController::class, 'addCartItem']);
});
