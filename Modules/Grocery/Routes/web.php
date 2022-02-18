<?php

Route::group(['prefix' => 'grocery', 'middleware' => 'auth'], function (){
    Route::get('/', [\Modules\Grocery\Http\Controllers\GroceryController::class, 'index'])->name('grocery.index');
    Route::get('/category', [\Modules\Grocery\Http\Controllers\GroceryCategoryController::class, 'index'])->name('grocery.category.index');
    Route::post('/category/store', [\Modules\Grocery\Http\Controllers\GroceryCategoryController::class, 'store'])->name('grocery.category.store');
    Route::get('/category/edit/{category_id}', [\Modules\Grocery\Http\Controllers\GroceryCategoryController::class, 'edit'])->name('grocery.category.edit');
    Route::delete('/category/delete/{category_id}', [\Modules\Grocery\Http\Controllers\GroceryCategoryController::class, 'destroy'])->name('grocery.category.delete');
});
