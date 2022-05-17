<?php
use Modules\ContentManagement\Http\Controllers\admin\CategoryController;
use Modules\ContentManagement\Http\Controllers\admin\HomeController;
use Modules\ContentManagement\Http\Controllers\admin\MenuController;
use Modules\ContentManagement\Http\Controllers\admin\PageController;
use Modules\ContentManagement\Http\Controllers\admin\StorageController;
use Modules\ContentManagement\Http\Controllers\ThemeController;

Route::get('/', [ThemeController::class, 'index'])->name('cms.index');
Route::get('/register-hospital', [HomeController::class, 'registerHospital'])->name('register-hospital');

Route::group(['prefix' => 'admin/cms', 'middleware' => 'auth'], function (){
    Route::get('/', [HomeController::class, 'index'])->name('cms.admin');

    Route::get('/category', [CategoryController::class, 'index'])->name('cms.category.index');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('cms.category.store');
    Route::get('/category/edit/{category_id}', [CategoryController::class, 'edit'])->name('cms.category.edit');
    Route::delete('/category/delete/{category_id}', [CategoryController::class, 'destroy'])->name('cms.category.delete');

    Route::group(['prefix' => 'page'], function (){
        Route::get('/', [PageController::class, 'index'])->name('cms.page.index');
        Route::get('/create', [PageController::class, 'create'])->name('cms.page.create');
        Route::get('/edit/{page_id}', [PageController::class, 'edit'])->name('cms.page.edit');
        Route::get('/delete/{page_id}', [PageController::class, 'delete'])->name('cms.page.delete');
    });

    Route::group(['prefix' => 'theme'], function (){
        Route::get('/', [ThemeController::class, 'adminIndex'])->name('cms.theme.index');
        Route::post('/update', [ThemeController::class, 'updateTheme'])->name('cms.theme.update');
        Route::get('/activate/{id}', [ThemeController::class, 'activateTheme'])->name('cms.theme.activate');
        Route::get('/scan', [ThemeController::class, 'scanTheme'])->name('cms.theme.scan');
    });

    Route::group(['prefix' => 'slider'], function (){
    });

    // MENU //
    Route::group(['prefix' => 'menu', 'as'=> 'cms.menu.'], function () {
        Route::get('/', [MenuController::class, 'admin_index'])->name('index');
        Route::post('create', [MenuController::class, 'create'])->name('create');
        Route::post('select', [MenuController::class, 'selectMenu'])->name('select');
        Route::post('save', [MenuController::class, 'save'])->name('save');
        Route::post('saveOrder', [MenuController::class, 'saveMenuOrder'])->name('saveOrder');
        Route::post('addPageToMenu', [MenuController::class, 'addPageToMenu'])->name('addPageToMenu');
        Route::post('addCategoryToMenu', [MenuController::class, 'addCategoryToMenu'])->name('addCategoryToMenu');
        Route::post('delete', [MenuController::class, 'delete'])->name('delete');
        Route::post('update', [MenuController::class, 'update'])->name('update');
    });

    Route::group(['prefix' => 'storage', 'as'=> 'cms.storage.'], function () {
        Route::get('/gallery', [StorageController::class, 'gallery_index'])->name('gallery.index');
        Route::get('/slider', [StorageController::class, 'slider_index'])->name('slider.index');
    });


    Route::group(['prefix' => 'web-api'],function() {
        Route::post('/page/update', [PageController::class, 'updatePage']);
        Route::get('/page/details/{page_id}', [PageController::class, 'pageDetails']);
        Route::delete('/page/deleteSection/{section_id}', [PageController::class, 'deleteSection']);
        Route::post('/page/addSection', [PageController::class, 'addSection']);
        Route::post('/page/updateSection', [PageController::class, 'updateSection']);
    });
});
