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
    Route::get('/province', [DataController::class, 'provinceIndex'])->name('admin.province');

    Route::group(['prefix' => 'web-api'],function() {

        // RELIGIONS
        Route::get('/religions', [DataController::class, 'religions']);
        Route::post('/religions/create', [DataController::class, 'religionsStore']);
        Route::delete('/religions/delete/{id}', [DataController::class, 'religionsDelete']);
        // RELIGIONS END

        // Ethnic Group 
        Route::get('/ethnic-groups', [DataController::class, 'ethnicGroups']);
        Route::post('/ethnic-groups/create', [DataController::class, 'ethnicGroupStore']);
        Route::delete('/ethnic-groups/delete/{id}', [DataController::class, 'ethnicGroupDelete']);
        // End Ethnic Group

        // Diseases
        Route::get('/diseases', [DataController::class, 'diseases']);
        Route::post('/diseases/create', [DataController::class, 'diseaseStore']);
        Route::delete('/diseases/delete/{id}', [DataController::class, 'diseaseDelete']);
        // End Diseases
        
        // Education Levels
        Route::get('education-levels', [DataController::class, 'educationLevels']);
        Route::post('/education-levels/create', [DataController::class, 'educationLevelStore']);
        Route::delete('/education-levels/delete/{id}', [DataController::class, 'educationLevelDelete']);
        // End  Education Levels

        //  Occupations
        Route::get('occupations', [DataController::class, 'occupations']);
        Route::post('/occupations/create', [DataController::class, 'occupationStore']);
        Route::delete('/occupations/delete/{id}', [DataController::class, 'occupationDelete']);
        // End Occupations

         //  Province
         Route::get('province', [DataController::class, 'province']);
         Route::post('/province/create', [DataController::class, 'provinceStore']);
         Route::delete('/province/delete/{id}', [DataController::class, 'provinceDelete']);
         // End Province
    });
});
