<?php

use Modules\Restaurant\Http\Controllers\RestaurantController;

Route::group(['prefix' => 'restaurant', 'middleware' => 'auth'], function (){
    Route::get('/', [RestaurantController::class, 'index'])->name('restaurant.index');
    Route::get('/list', [RestaurantController::class, 'listing'])->name('restaurant.list');
    Route::get('/edit/{id}', [RestaurantController::class, 'edit'])->name('restaurant.edit');

    Route::group(['prefix' => 'web_api'],function() {
        Route::post('/create', [RestaurantController::class, 'store']);
        Route::get('/list', [RestaurantController::class, 'apiListing']);
        Route::delete('/delete/{id}', [RestaurantController::class, 'destroy']);
    });
});
