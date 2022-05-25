<?php

use Modules\Hospital\Http\Controllers\HospitalController;
use Modules\Hospital\Http\Controllers\PatientController;

//Route::prefix('hospital')->middleware(['auth', 'hospital'])->group(function() {
Route::group(['prefix' => 'hospital', 'middleware' => ['auth', 'hospital'], 'as' => 'hospital.'],function() {
    Route::get('/', [HospitalController::class, 'index'])->name('index');

    Route::group(['prefix' => 'patient','middleware' => 'license'], function (){
        Route::get('/', [PatientController::class, 'index'])->name('patients');
        Route::get('/update/{patient_id}', [PatientController::class, 'edit'])->name('patient.edit');
    });

    Route::get('/profile', [HospitalController::class, 'profile'])->name('profile');

    Route::group(['prefix' => 'web-api'], function (){
        Route::group(['prefix' => 'patient'], function (){
            Route::get('/list', [PatientController::class, 'getPatientList']);
            Route::post('/create', [PatientController::class, 'savePatient']);
            Route::delete('/delete/{patient_id}', [PatientController::class, 'deletePatient']);
            Route::post('/update', [PatientController::class, 'updatePatient']);
        });
    });
});
