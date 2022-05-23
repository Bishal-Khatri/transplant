<?php

use Modules\Hospital\Http\Controllers\HospitalController;
use Modules\Hospital\Http\Controllers\PatientController;

//Route::prefix('hospital')->middleware(['auth', 'hospital'])->group(function() {
Route::group(['prefix' => 'hospital', 'middleware' => ['auth', 'hospital'], 'as' => 'hospital.'],function() {
    Route::get('/', [HospitalController::class, 'index'])->name('index');

    Route::group(['prefix' => 'patient','middleware' => 'license'], function (){
        Route::get('/', [PatientController::class, 'index'])->name('patients');
        Route::get('/create', [PatientController::class, 'create'])->name('patient.create');
    });

    Route::get('/profile', [HospitalController::class, 'profile'])->name('profile');

    Route::group(['prefix' => 'web-api'], function (){
        Route::get('/patient-list', [HospitalController::class, 'getPatientList']);
    });
});
