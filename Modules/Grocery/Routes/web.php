<?php

Route::group(['prefix' => 'grocery'], function (){
    Route::get('/', 'GroceryController@index')->name('grocery.index');
});
