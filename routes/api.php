<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login/email', [\App\Http\Controllers\Auth\LoginController::class, 'apiEmailLogin']);
Route::post('/login/phone', [\App\Http\Controllers\Auth\LoginController::class, 'apiPhoneLogin']);
Route::post('/validateOtp', [\App\Http\Controllers\Auth\LoginController::class, 'validateOtp']);

Route::group(['middleware' => 'auth:sanctum'], function (){
    Route::get('/me', [\App\Http\Controllers\Auth\LoginController::class, 'getMyProfile']);
    Route::post('/me', [\App\Http\Controllers\Auth\LoginController::class, 'updateMyProfile']);

    Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'apiLogout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
