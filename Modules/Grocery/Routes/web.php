<?php

Route::group(['prefix' => 'grocery', 'middleware' => 'auth'], function (){
    Route::get('/', [\Modules\Grocery\Http\Controllers\GroceryController::class, 'index'])->name('grocery.index');
    Route::get('/category', [\Modules\Grocery\Http\Controllers\GroceryCategoryController::class, 'index'])->name('grocery.category.index');
    Route::post('/category/store', [\Modules\Grocery\Http\Controllers\GroceryCategoryController::class, 'store'])->name('grocery.category.store');
    Route::get('/category/edit/{category_id}', [\Modules\Grocery\Http\Controllers\GroceryCategoryController::class, 'edit'])->name('grocery.category.edit');
    Route::delete('/category/delete/{category_id}', [\Modules\Grocery\Http\Controllers\GroceryCategoryController::class, 'destroy'])->name('grocery.category.delete');

    Route::group(['prefix' => 'item'], function () {
        Route::get('/', [\Modules\Grocery\Http\Controllers\ItemController::class, 'index'])->name('grocery.item.index');
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('/', [\Modules\Grocery\Http\Controllers\OrderController::class, 'index'])->name('grocery.order.index');
    });



    Route::group(['prefix' => 'inventory'],function() {
//        Route::get('category/list', [\App\Http\Controllers\Inventory\CategoryController::class, 'listing']);
//        Route::post('category/create', [\App\Http\Controllers\Inventory\CategoryController::class, 'save']);
//        Route::get('category/delete/{category_id}', [\App\Http\Controllers\Inventory\CategoryController::class, 'delete']);

        // brands
        Route::get('brand/index', [\Modules\Grocery\Http\Controllers\BrandController::class, 'index'])->name('grocery.brand.index');
        Route::get('brand/list', [\Modules\Grocery\Http\Controllers\BrandController::class, 'listing']);
        Route::post('brand/create', [\Modules\Grocery\Http\Controllers\BrandController::class, 'save']);
        Route::get('brand/delete/{brand_id}', [\Modules\Grocery\Http\Controllers\BrandController::class, 'delete']);

        // vendors
//        Route::get('vendor/list', [\App\Http\Controllers\Inventory\VendorController::class, 'listing']);
//        Route::post('vendor/create', [\App\Http\Controllers\Inventory\VendorController::class, 'save']);
//        Route::get('vendor/delete/{vendor_id}', [\App\Http\Controllers\Inventory\VendorController::class, 'delete']);

        // items
        Route::get('item/list', [\Modules\Grocery\Http\Controllers\ItemController::class, 'listing']);
        Route::post('item/create', [\Modules\Grocery\Http\Controllers\ItemController::class, 'save']);
        Route::get('item/edit/{id}', [\Modules\Grocery\Http\Controllers\ItemController::class, 'edit'])->name('grocery.item.edit');
        Route::get('item/delete/{item_id}', [\Modules\Grocery\Http\Controllers\ItemController::class, 'delete']);
        Route::get('item/deleteQuantity/{item_quantity_id}', [\Modules\Grocery\Http\Controllers\ItemController::class, 'deleteQuantity']);
        Route::post('item/addQuantity', [\Modules\Grocery\Http\Controllers\ItemController::class, 'addQuantity']);
        Route::get('item/getItemDetails/{item_id}', [\Modules\Grocery\Http\Controllers\ItemController::class, 'getItemDetails']);
        Route::post('item/uploadAdditionalImage', [\Modules\Grocery\Http\Controllers\ItemController::class, 'uploadAdditionalImage']);
        Route::get('item/deleteAdditionalImage/{image_id}', [\Modules\Grocery\Http\Controllers\ItemController::class, 'deleteAdditionalImage']);
    });
});
