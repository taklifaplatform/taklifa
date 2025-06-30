<?php

use Illuminate\Support\Facades\Route;
use Modules\Notification\Http\Controllers\ExpoPushNotificationController;
use Modules\Notification\Http\Controllers\NotificationController;

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

Route::middleware('auth:sanctum')->prefix('notifications')->group(static function (): void {
    Route::get('', [NotificationController::class, 'listNotifications']);
    Route::post('mark-all-as-read', [NotificationController::class, 'markAllNotificationsAsRead']);
    Route::get('/unread-count', [NotificationController::class, 'getUnreadNotificationCount']);
    Route::post('expo-token', [ExpoPushNotificationController::class, 'storeExpoToken']);
});
