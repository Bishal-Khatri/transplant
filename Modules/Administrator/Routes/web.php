<?php

use Modules\Administrator\Http\Controllers\AddressController;
use Modules\Administrator\Http\Controllers\AdministratorController;
use Modules\Administrator\Http\Controllers\DataController;
use Modules\Administrator\Http\Controllers\HospitalController;
Route::prefix('admin')->middleware(['auth', 'administrator'])->group(function() {
    Route::get('/', [AdministratorController::class, 'index'])->name('admin.index');

    Route::get('/religion', [DataController::class, 'religionIndex'])->name('admin.religion');
    Route::get('/ethnic-group', [DataController::class, 'ethnicGroupIndex'])->name('admin.ethnic-group');
    Route::get('/disease', [DataController::class, 'diseaseIndex'])->name('admin.disease');
    Route::get('/education-level', [DataController::class, 'educationLevelIndex'])->name('admin.education-level');
    Route::get('/occupation', [DataController::class, 'occupationIndex'])->name('admin.occupation');

    Route::get('/province', [AddressController::class, 'provinceIndex'])->name('admin.province');
    Route::get('/district', [AddressController::class, 'districtIndex'])->name('admin.district');
    Route::get('/local-level', [AddressController::class, 'localLevelIndex'])->name('admin.local-level');

    // hospital waiting list
    Route::get('/hospital-list', [\Modules\Administrator\Http\Controllers\HospitalController::class, 'listHospitals'])->name('admin.hospital.list');
    Route::get('/hospital-create', [\Modules\Administrator\Http\Controllers\HospitalController::class, 'createHospital'])->name('admin.hospital.create');
    Route::get('/hospital-display/{id}', [\Modules\Administrator\Http\Controllers\HospitalController::class, 'displayHospital'])->name('admin.hospital.display');

    Route::group(['prefix' => 'web-api'],function() {

        Route::get('/hospitals-details/{id}', [HospitalController::class, 'getHospitalDetails']);

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
         Route::get('province', [AddressController::class, 'province']);
         Route::post('/province/create', [AddressController::class, 'provinceStore']);
         Route::delete('/province/delete/{id}', [AddressController::class, 'provinceDelete']);
         // End Province

        //  District
        Route::get('district', [AddressController::class, 'district']);
        Route::post('/district/create', [AddressController::class, 'districtStore']);
        Route::delete('/district/delete/{id}', [AddressController::class, 'districtDelete']);
         // End District

        //  Municipality Level
        Route::get('municipality', [AddressController::class, 'municipality']);
        Route::post('/municipality/create', [AddressController::class, 'municipalityStore']);
        Route::delete('/municipality/delete/{id}', [AddressController::class, 'municipalityDelete']);
         // End Municipality

        //  Palika Level
        Route::get('palika', [AddressController::class, 'palika']);
        Route::post('/palika/create', [AddressController::class, 'palikaStore']);
        Route::delete('/palika/delete/{id}', [AddressController::class, 'palikaDelete']);
        // End Palika

        // Hospital
        Route::get('/hospitals', [HospitalController::class, 'hospitals'])->name('admin.hospital.index');
        Route::post('/hospitals/create', [HospitalController::class, 'store']);
        Route::delete('/hospitals/delete/{id}', [HospitalController::class, 'delete']);

        Route::post('/hospital-update-status', [HospitalController::class, 'changeHospitalStatus']);

        Route::post('/hospital-approve', [HospitalController::class, 'approveHospital']);
        Route::post('/hospital-reject', [HospitalController::class, 'rejectHospital']);
        // End Hospital
    });
});
