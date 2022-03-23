<?php

use Modules\Restaurant\Http\Controllers\RestaurantController;

Route::group(['prefix' => 'restaurant', 'middleware' => 'auth'], function (){
    Route::get('/', [RestaurantController::class, 'index'])->name('restaurant.index');
    Route::get('/list', [RestaurantController::class, 'listing'])->name('restaurant.list');
    Route::get('/edit/{id}', [RestaurantController::class, 'edit'])->name('restaurant.edit');

    Route::group(['prefix' => 'amenity'],function() {
        Route::get('/', [RestaurantController::class, 'amenityIndex'])->name('restaurant.amenity.index');
        Route::get('/create', [RestaurantController::class, 'amenityCreate'])->name('restaurant.amenity.create');
        Route::get('/edit/{id}', [RestaurantController::class, 'amenityEdit'])->name('restaurant.amenity.edit');
        Route::post('/store', [RestaurantController::class, 'amenitySave'])->name('restaurant.amenity.store');
        Route::get('/delete/{id}', [RestaurantController::class, 'amenityDelete'])->name('restaurant.amenity.delete');
    });

    Route::group(['prefix' => 'web_api'],function() {
        Route::post('/create', [RestaurantController::class, 'store']);
        Route::get('/list', [RestaurantController::class, 'apiListing']);
        Route::delete('/delete/{id}', [RestaurantController::class, 'destroy']);
        Route::post('/saveItem', [RestaurantController::class, 'saveMenuItem']);
        Route::delete('/deleteMenuItem/{id}', [RestaurantController::class, 'deleteMenuItem']);
    });
});
