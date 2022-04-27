<?php

use Illuminate\Http\Request;
use Modules\Cart\Http\Controllers\CartController;
use Modules\Cart\Http\Controllers\OrderController;

Route::group(['middleware' => 'auth:sanctum'], function (){
    Route::prefix('cart')->group(function() {
        Route::post('/addToCart', [CartController::class, 'addToCart']);
        Route::post('/removeFromCart', [CartController::class, 'removeFromCart']);
        Route::get('/getCart', [CartController::class, 'cartListing']);
        Route::post('/createOrder', [CartController::class, 'createOrder']);
        Route::post('/order', [CartController::class, 'displayOrder']);
        Route::get('/orders', [CartController::class, 'listOrders']);

        Route::get('/assignedOrder', [OrderController::class, 'getAssignedOrder']);
        Route::post('/updatePaymentStatus', [ OrderController::class, 'updatePaymentStatus']);
        Route::post('/updateOrderStatus', [ OrderController::class, 'updateOrderStatus']);

        Route::post('/createImageOrder', [ OrderController::class, 'saveImageOrder']);
    });
});
