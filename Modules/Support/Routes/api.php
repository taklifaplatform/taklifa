<?php

use Illuminate\Support\Facades\Route;
use Modules\Support\Http\Controllers\FaqController;
use Modules\Support\Http\Controllers\ReportController;
use Modules\Support\Http\Controllers\SupportController;

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

// Public routes for faqs

Route::get('faqs', [FaqController::class, 'fetchListFaqs']);

// Public routes for support

Route::get('/support/categories', [SupportController::class, 'fetchSupportCategories']);
Route::post('/support', [SupportController::class, 'storeSupportRequest']);

// Public routes for report

Route::get('/support/report-reasons', [ReportController::class, 'fetchReportReason']);

// Protected routes for report
Route::middleware(['auth:sanctum'])->group(static function (): void {
    Route::post('/support/reports', [ReportController::class, 'storeReport']);
});
