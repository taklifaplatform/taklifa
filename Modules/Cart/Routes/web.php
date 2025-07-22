<?php

use Illuminate\Support\Facades\Route;
use Modules\Cart\Http\Controllers\PdfCartController;

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

// Test interface for invoice system
Route::get('/invoice-test', function () {
    return view('cart::test-invoice');
})->name('cart.test-interface');

// Test page for PDF invoice
Route::get('/test-pdf', [PdfCartController::class, 'testInvoice'])->name('cart.test-page');

// Test route for PDF invoice download with cart ID
Route::get('/cart/{cart_id}/download-pdf', [PdfCartController::class, 'testDownloadInvoice']);

