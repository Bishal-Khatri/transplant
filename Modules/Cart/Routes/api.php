<?php

use Illuminate\Http\Request;

Route::group(['middleware' => 'auth:sanctum'], function (){
    Route::prefix('cart')->group(function() {
        Route::post('/addToCart', [\Modules\Cart\Http\Controllers\CartController::class, 'addToCart']);
        Route::post('/removeFromCart', [\Modules\Cart\Http\Controllers\CartController::class, 'removeFromCart']);
        Route::get('/getCart', [\Modules\Cart\Http\Controllers\CartController::class, 'cartListing']);
    });
});
