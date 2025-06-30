<?php

use Illuminate\Support\Facades\Route;
use Modules\Media\Http\Controllers\S3UploadUrlController;
use Modules\Media\Http\Controllers\MediaLibraryPostS3Controller;
use Modules\Media\Http\Controllers\MediaLibraryUploadController;

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

Route::middleware('auth:sanctum')->prefix('media')->group(static function (): void {
    Route::post('s3-upload-url', '\\' . S3UploadUrlController::class)
        ->name('media-s3-upload-url');

    Route::post('s3-upload-url/convert', '\\' . S3UploadUrlController::class . '@convertToTemporaryUpload')
        ->name('media-s3-upload-url-convert');

    Route::post('post-s3', '\\' . MediaLibraryPostS3Controller::class)
        ->name('media-library-post-s3')
        ->middleware(['throttle:medialibrary-pro-uploads']);
    Route::post('uploads', '\\' . MediaLibraryUploadController::class)
        ->name('media-library-uploads');
    Route::delete('uploads', [MediaLibraryUploadController::class, 'deleteMedia'])
        ->name('media-delete-uploads');
    // ->middleware(['throttle:medialibrary-pro-uploads'])
});
