<?php

use Modules\Restaurant\Http\Controllers\RestaurantController;

Route::prefix('restaurant')->group(function() {
    Route::get('/', [RestaurantController::class, 'index'])->name('restaurant.index');
    Route::get('/list', [RestaurantController::class, 'listing'])->name('restaurant.list');

    Route::group(['prefix' => 'web_api'],function() {
        Route::post('/create', [RestaurantController::class, 'store']);
        Route::get('/list', [RestaurantController::class, 'apiListing']);
        Route::delete('/delete/{id}', [RestaurantController::class, 'destroy']);
    });
});
