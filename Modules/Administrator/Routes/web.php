<?php

use Modules\Administrator\Http\Controllers\AdministratorController;
use Modules\Administrator\Http\Controllers\DataController;

Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('/', [AdministratorController::class, 'index'])->name('admin.index');

    Route::get('/religion', [DataController::class, 'religionIndex'])->name('admin.religion');
    Route::get('/ethnic-group', [DataController::class, 'ethnicGroupIndex'])->name('admin.ethnic-group');
    Route::get('/disease', [DataController::class, 'diseaseIndex'])->name('admin.disease');
    Route::get('/education-level', [DataController::class, 'educationLevelIndex'])->name('admin.education-level');
    Route::get('/occupation', [DataController::class, 'occupationIndex'])->name('admin.occupation');

    Route::group(['prefix' => 'web-api'],function() {

        // RELIGIONS
        Route::get('/religions', [DataController::class, 'religions']);
        Route::post('/religions/create', [DataController::class, 'religionsStore']);
        Route::delete('/religions/delete/{id}', [DataController::class, 'religionsDelete']);
        // RELIGIONS END


    });
});
