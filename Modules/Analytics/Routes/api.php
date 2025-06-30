<?php

use Illuminate\Support\Facades\Route;
use Modules\Analytics\Http\Controllers\UserAnalyticController;
use Modules\Analytics\Http\Controllers\AnnouncementAnalyticController;

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

Route::prefix('analytics/track')->group(function () {
    Route::post('/users/{user}', [UserAnalyticController::class, 'storeUserAnalytic']);
    Route::post('/announcements/{announcement}', [AnnouncementAnalyticController::class, 'storeAnnouncementAnalytic']);

    // api for getting user analytics
    Route::get('/users/{user}/analytics', [UserAnalyticController::class, 'getUserAnalytics']);
    // api for getting announcement analytics
    Route::get('/announcements/{announcement}/analytics', [AnnouncementAnalyticController::class, 'getAnnouncementAnalytics']);
});
