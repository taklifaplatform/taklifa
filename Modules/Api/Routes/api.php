<?php

use Illuminate\Support\Facades\Route;
use Modules\Api\Http\Controllers\OpenApiController;
use Modules\Api\Http\Controllers\SwaggerViewController;

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

Route::middleware('api')->get('docs/v1', OpenApiController::class)->name('api-schema');
Route::get('docs', SwaggerViewController::class)->name('swagger');
