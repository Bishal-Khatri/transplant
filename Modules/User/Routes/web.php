<?php
use Modules\User\Http\Controllers\UserController;

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function (){
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/roles', [UserController::class, 'index'])->name('user.roles');

    Route::group(['prefix' => '/web-api'],function() {
        Route::get('/list', [UserController::class, 'userListing']);
        Route::post('/register', [UserController::class, 'registerUser']);
    });
});
