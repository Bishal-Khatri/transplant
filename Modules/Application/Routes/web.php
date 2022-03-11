<?php

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

Route::prefix('application')->group(function() {
    Route::get('/', [\Modules\Application\Http\Controllers\ApplicationController::class, 'index'])->name('application');

    Route::prefix('banners')->group(function() {
        Route::get('/', [\Modules\Application\Http\Controllers\BannerController::class, 'index'])->name('application.banners');
        Route::post('/create', [\Modules\Application\Http\Controllers\BannerController::class, 'store'])->name('application.banners.create');
        Route::get('/delete/{id}', [\Modules\Application\Http\Controllers\BannerController::class, 'destroy'])->name('application.banners.delete');
    });
});
