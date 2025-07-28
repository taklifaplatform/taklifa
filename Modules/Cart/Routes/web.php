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
    $imageUrl = 'https://taklifa.fra1.digitaloceanspaces.com/501/68872d0c6ae4c.jpg';
    return AiProductService::analyzeImageForProduct($imageUrl);
});