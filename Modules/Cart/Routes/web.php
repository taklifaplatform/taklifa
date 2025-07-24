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

Route::get('/download/cart/invoice/{code}', [PdfCartController::class, 'downloadCartInvoice']);
