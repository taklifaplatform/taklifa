<?php

use Illuminate\Support\Facades\Route;
use Modules\Geography\Http\Controllers\CitiesController;
use Modules\Geography\Http\Controllers\CountriesController;
use Modules\Geography\Http\Controllers\CurrenciesController;
use Modules\Geography\Http\Controllers\LiveLocationController;
use Modules\Geography\Http\Controllers\LocationController;
use Modules\Geography\Http\Controllers\StatesController;

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

Route::prefix('geography')->group(static function (): void {
    Route::get('countries', [CountriesController::class, 'listCountries']);
    Route::get('countries/{country}', [CountriesController::class, 'showCountry']);
    Route::get('countries/dial-code/{dialCode}', [CountriesController::class, 'getCountryByDialCode']);
    Route::get('states', [StatesController::class, 'index']);
    Route::get('cities', [CitiesController::class, 'index']);
    Route::get('currencies', [CurrenciesController::class, 'listCurrencies']);
    Route::get('currencies/{currency}', [CurrenciesController::class, 'showCurrency']);
});

Route::prefix('locations')->group(static function (): void {
    Route::get('{location}', [LocationController::class, 'retrieve']);
    Route::middleware(['auth:sanctum'])->put('{location}', [LocationController::class, 'update']);
    Route::middleware(['auth:sanctum'])->post('', [LocationController::class, 'create']);

    Route::middleware(['auth:sanctum'])->post('live-location/create', [LiveLocationController::class, 'updateLiveLocation']);
});
