<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/setup', [App\Http\Controllers\SetupController::class,'getSetup'])->name('getSetup');
Route::post('/setup/run', [App\Http\Controllers\SetupController::class,'runSetup'])->name('setup.run');
