<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\Api\ProductController;
use Modules\Product\Http\Controllers\Api\ProductCategoryController;

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
    Route::get('/', [ProductCategoryController::class, 'index'])->name('product-categories.index');
    Route::post('/', [ProductCategoryController::class, 'store'])->name('product-categories.store');
    Route::get('/{productCategory}', [ProductCategoryController::class, 'show'])->name('product-categories.show');
    Route::put('/{productCategory}', [ProductCategoryController::class, 'update'])->name('product-categories.update');
    Route::delete('/{productCategory}', [ProductCategoryController::class, 'destroy'])->name('product-categories.destroy');
});

// Products API Routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});
