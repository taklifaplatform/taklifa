<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;
use Modules\Product\Http\Controllers\ProductCategoryController;

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

Route::middleware('auth:sanctum')->get('/product', function (Request $request) {
    return $request->user();
});

// Product Categories API Routes
Route::prefix('product-categories')->group(function () {
    Route::get('/', [ProductCategoryController::class, 'list']);
    Route::post('/', [ProductCategoryController::class, 'store']);
    Route::get('/{productCategory}', [ProductCategoryController::class, 'retrieve']);
    Route::put('/{productCategory}', [ProductCategoryController::class, 'update']);
    Route::delete('/{productCategory}', [ProductCategoryController::class, 'delete']);
});

// Products API Routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'fetchAllProduct']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('/{product}', [ProductController::class, 'retrieveProduct']);
    Route::put('/{product}', [ProductController::class, 'updateProduct']);
    Route::delete('/{product}', [ProductController::class, 'deleteProduct']);
});
