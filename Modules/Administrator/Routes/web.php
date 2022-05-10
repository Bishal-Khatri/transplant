<?php

use Modules\Administrator\Http\Controllers\AdministratorController;

Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('/', [AdministratorController::class, 'index'])->name('admin.index');

    Route::group(['prefix' => 'web-api'],function() {

    });
});
