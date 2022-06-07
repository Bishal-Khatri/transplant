<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/change-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class,'showChangePassword'])->name('change-password');
Route::post('/change-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class,'changePassword'])->name('change-password');

Route::get('/setup', [App\Http\Controllers\SetupController::class,'getSetup'])->name('getSetup');
Route::post('/setup/run', [App\Http\Controllers\SetupController::class,'runSetup'])->name('setup.run');
