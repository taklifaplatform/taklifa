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

// Invoice System Routes

// Test index page with all available links
Route::get('/test-invoice-index', function () {
    return view('cart::pdf.test-index');
})->name('cart.test-index');

// Test page for PDF invoice development (HTML preview)
Route::get('/test-pdf', [PdfCartController::class, 'testInvoice'])->name('cart.test-invoice');

// Test PDF download with specific cart ID
Route::get('/test-cart-pdf/{cart_id}', [PdfCartController::class, 'testDownloadInvoice'])
    ->where('cart_id', '[0-9a-f\-]{36}')
    ->name('cart.test-cart-pdf');

// Test PDF with all cart items for a company
Route::get('/test-company-pdf/{company_id?}', [PdfCartController::class, 'testInvoiceForCompany'])
    ->where('company_id', '[0-9]+')
    ->name('cart.test-company-pdf');

// Test PDF download with sample data


Route::get('/download/cart/invoice/{code}', [PdfCartController::class, 'downloadCartInvoice']);
