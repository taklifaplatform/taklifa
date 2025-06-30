<?php

use Illuminate\Support\Facades\Route;
use Modules\Announcements\Http\Controllers\AnnouncementsController;
use Modules\Announcements\Http\Controllers\ManageAnnouncementController;
use Modules\Announcements\Http\Controllers\AnnouncementCategoriesController;

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

/**
 * Announcements endpoints
 */
Route::prefix('/announcements')->group(static function (): void {
    // Public endpoints services
    Route::get('/', [AnnouncementsController::class, 'listAnnouncements']);
    Route::get('/{announcement}', [AnnouncementsController::class, 'retrieveAnnouncement']);
});

/**
 * Announcement Categories endpoints
 */
Route::prefix('/announcement-categories')->group(static function (): void {
    // Public endpoints services
    Route::get('/', [AnnouncementCategoriesController::class, 'listAnnouncementCategories']);
});


Route::middleware('auth:sanctum')->prefix('/announcements')->group(static function (): void {
    Route::post('/', [ManageAnnouncementController::class, 'createAnnouncement']);
    Route::put('/{announcement}', [ManageAnnouncementController::class, 'updateAnnouncement']);
    Route::delete('/{announcement}', [ManageAnnouncementController::class, 'deleteAnnouncement']);
});
