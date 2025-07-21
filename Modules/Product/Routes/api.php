<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;
use Modules\Product\Http\Controllers\ManageProductController;
use Modules\Product\Http\Controllers\AiProductBatchController;
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


// Product Categories API Routes
Route::prefix('product-categories')->group(function () {
    Route::get('/parents', [ProductCategoryController::class, 'listParents']); // List all parent categories (Level 1)
    Route::get('/{categoryId}', [ProductCategoryController::class, 'retrieveMainCategory']); // Retrieve specific category with its sub-categories
    Route::get('/{mainCategoryId}/sub-categories', [ProductCategoryController::class, 'retrieveSubCategories']); // List sub-categories for a main category (Level 3)
});

// Products API RoutesA
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'fetchAllProduct']);
    Route::get('/{product}', [ProductController::class, 'retrieveProduct']);
});


Route::middleware('auth:sanctum')->prefix('/products')->group(static function (): void {
    Route::post('/', [ManageProductController::class, 'storeProduct']);
    Route::put('/{product}', [ManageProductController::class, 'updateProduct']);
    Route::delete('/{product}', [ManageProductController::class, 'deleteProduct']);

    // AI Batch Create endpoints
    Route::post('/ai/batch-create', [AiProductBatchController::class, 'batchCreate']);
    Route::post('/ai/batch-create/{batchProduct}/products', [AiProductBatchController::class, 'generateProducts']);
});


