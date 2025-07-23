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


// Cart Routes
Route::middleware('auth:sanctum')->prefix('/cart')->group(function () {
    Route::get('/{code}', [CartController::class, 'getCart']);
    Route::post('/{code}/items', [CartController::class, 'addItem']);
});
