<?php

use Modules\Restaurant\Http\Controllers\AppointmentController;
use Modules\Restaurant\Http\Controllers\RestaurantController;
use Modules\Restaurant\Http\Controllers\RestaurantClientController;

Route::group(['prefix' => 'restaurant', 'middleware' => ['auth', 'administrator']], function (){
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
        Route::delete('/deleteMenuItem/{id}', [RestaurantController::class, 'deleteMenuItem']);
        Route::post('/addAmenity', [RestaurantController::class, 'addAmenity']);
    });
});

// APPOINTMENT
Route::group(['prefix' => 'appointment', 'as'=> 'appointment.'],function() {
    Route::get('/', [AppointmentController::class, 'index'])->name('index');
    Route::get('/create', [AppointmentController::class, 'create'])->name('create');
    Route::get('/edit/{id}', [AppointmentController::class, 'edit'])->name('edit');
    Route::post('/store', [AppointmentController::class, 'store'])->name('store');
    Route::get('/delete/{id}', [AppointmentController::class, 'destroy'])->name('delete');
});

Route::post('/restaurant/web_api/saveItem', [RestaurantController::class, 'saveMenuItem'])->middleware('auth');


Route::group(['prefix' => 'restaurant/client', 'middleware'=> ['auth', 'restaurant'], 'as' => 'restaurant.client.'],function() {
    Route::get('/', [RestaurantClientController::class, 'index'])->name('index');

    Route::group(['prefix' => 'web-api'],function() {
        Route::get('/orderList', [RestaurantClientController::class, 'orderList']);
        Route::post('/updateItemStatus', [RestaurantClientController::class, 'updateItemStatus']);
        Route::get('/getMenu', [RestaurantClientController::class, 'getMenu']);
    });
});
