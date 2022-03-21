<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/setup', [App\Http\Controllers\SetupController::class,'getSetup'])->name('getSetup');
Route::post('/setup/run', [App\Http\Controllers\SetupController::class,'runSetup'])->name('setup.run');

Route::get('/category/grocery', [CategoryController::class, 'groceryIndex'])->name('grocery.category.index');
Route::get('/category/restaurant', [CategoryController::class, 'restaurantIndex'])->name('restaurant.category.index');
Route::post('/category/store', [CategoryController::class, 'store'])->name('grocery.category.store');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'edit'])->name('grocery.category.edit');
Route::delete('/category/delete/{category_id}', [CategoryController::class, 'destroy'])->name('grocery.category.delete');
