<?php

use Illuminate\Support\Facades\Route;

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


// add get route to change the lang, route name should be change-lang it will accept lang, and redirect to the previous page
Route::get('change-lang/{lang}', function ($lang) {
    session()->put('locale', $lang);
    app()->setLocale($lang);

    return redirect()->back();
})->name('change-lang');