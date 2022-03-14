<?php

use Modules\Grocery\Http\Controllers\BrandController;
use Modules\Grocery\Http\Controllers\GroceryCategoryController;
use Modules\Grocery\Http\Controllers\GroceryController;
use Modules\Grocery\Http\Controllers\ItemController;
use Modules\Grocery\Http\Controllers\OrderController;

Route::group(['prefix' => 'grocery', 'middleware' => 'auth'], function (){
    Route::get('/', [GroceryController::class, 'index'])->name('grocery.index');
    Route::get('/category', [GroceryCategoryController::class, 'index'])->name('grocery.category.index');
    Route::post('/category/store', [GroceryCategoryController::class, 'store'])->name('grocery.category.store');
    Route::get('/category/edit/{category_id}', [GroceryCategoryController::class, 'edit'])->name('grocery.category.edit');
    Route::delete('/category/delete/{category_id}', [GroceryCategoryController::class, 'destroy'])->name('grocery.category.delete');

    Route::group(['prefix' => 'item'], function () {
        Route::get('/', [ItemController::class, 'index'])->name('grocery.item.index');
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('grocery.order.index');
    });



    Route::group(['prefix' => 'inventory'],function() {
//        Route::get('category/list', [\App\Http\Controllers\Inventory\CategoryController::class, 'listing']);
//        Route::post('category/create', [\App\Http\Controllers\Inventory\CategoryController::class, 'save']);
//        Route::get('category/delete/{category_id}', [\App\Http\Controllers\Inventory\CategoryController::class, 'delete']);

        // brands
        Route::get('brand/index', [BrandController::class, 'index'])->name('grocery.brand.index');
        Route::get('brand/list', [BrandController::class, 'listing']);
        Route::post('brand/create', [BrandController::class, 'save']);
        Route::get('brand/delete/{brand_id}', [BrandController::class, 'delete']);

        // vendors
//        Route::get('vendor/list', [\App\Http\Controllers\Inventory\VendorController::class, 'listing']);
//        Route::post('vendor/create', [\App\Http\Controllers\Inventory\VendorController::class, 'save']);
//        Route::get('vendor/delete/{vendor_id}', [\App\Http\Controllers\Inventory\VendorController::class, 'delete']);

        // items
        Route::get('item/list', [ ItemController::class, 'listing']);
        Route::post('item/create', [ ItemController::class, 'save']);
        Route::get('item/edit/{id}', [ ItemController::class, 'edit'])->name('grocery.item.edit');
        Route::get('item/delete/{item_id}', [ ItemController::class, 'delete']);
        Route::get('item/deleteQuantity/{item_quantity_id}', [ ItemController::class, 'deleteQuantity']);
        Route::post('item/addQuantity', [ ItemController::class, 'addQuantity']);
        Route::get('item/getItemDetails/{item_id}', [ ItemController::class, 'getItemDetails']);
        Route::post('item/uploadAdditionalImage', [ ItemController::class, 'uploadAdditionalImage']);
        Route::get('item/deleteAdditionalImage/{image_id}', [ ItemController::class, 'deleteAdditionalImage']);
    });
});
