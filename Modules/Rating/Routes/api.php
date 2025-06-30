<?php

use Illuminate\Support\Facades\Route;
use Modules\Rating\Http\Controllers\RatingController;

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

Route::get('rating-types', [RatingController::class, 'fetchRatingTypes']);

Route::get('ratings/{id}', [RatingController::class, 'fetchRatings']);

Route::middleware(['auth:sanctum'])->group(static function (): void {
    Route::post('rating', [RatingController::class, 'storeRating']);
});
