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


use Modules\Cart\Http\Controllers\OrderController;

Route::prefix('cart')->middleware('auth')->group(function() {
    Route::group(['prefix' => 'order'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('cart.order.index');
        Route::get('/edit/{order_id}', [OrderController::class, 'edit'])->name('cart.order.edit');
        Route::get('/image-order', [OrderController::class, 'imageOrder'])->name('cart.order.image-order');
    });

    Route::group(['prefix' => 'web-api'],function() {
        Route::group(['prefix' => 'order'],function() {
            Route::get('/list', [ OrderController::class, 'listOrders']);
            Route::get('/orderDetails/{order_id}', [ OrderController::class, 'orderDetails']);
            Route::post('/updatePaymentStatus', [ OrderController::class, 'updatePaymentStatus']);
            Route::post('/updateOrderStatus', [ OrderController::class, 'updateOrderStatus']);
            Route::post('/assignOrder', [ OrderController::class, 'assignOrder']);

            Route::get('/imageOrders', [ OrderController::class, 'getImageOrders']);
            Route::post('/updateImageOrderStatus', [ OrderController::class, 'updateImageOrderStatus']);
        });
    });
});
