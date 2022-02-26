<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/setup', [App\Http\Controllers\SetupController::class,'getSetup'])->name('getSetup');
Route::post('/setup/run', [App\Http\Controllers\SetupController::class,'runSetup'])->name('setup.run');
