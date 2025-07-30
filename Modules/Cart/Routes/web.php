<?php

use Illuminate\Support\Facades\Route;
use Modules\Cart\Http\Controllers\PdfCartController;
use Modules\Product\Services\AiProductService;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Invoice System Routes

Route::get('/download/cart/invoice/{code}', [PdfCartController::class, 'downloadCartInvoice']);

/**
 * TODO: add product info
 * tags
 * colors
 * details (array of key value pairs)
 */
Route::get('test-ai', function() {
    $imageUrl = 'https://taklifa.fra1.digitaloceanspaces.com/222/5790796d-2f4a-4eff-8aae-9a3e5dd9a903.jpg';
    return AiProductService::analyzeImageForProduct($imageUrl);
});