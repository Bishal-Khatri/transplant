<?php

Route::prefix('restaurant')->group(function() {
    Route::get('/', 'RestaurantController@index')->name('restaurant.index');
});
