<?php

use Modules\Hospital\Http\Controllers\HospitalController;
use Modules\Hospital\Http\Controllers\PatientController;

//Route::prefix('hospital')->middleware(['auth', 'hospital'])->group(function() {
Route::group(['prefix' => 'hospital', 'middleware' => ['auth', 'hospital'], 'as' => 'hospital.'],function() {
    Route::get('/', [HospitalController::class, 'index'])->name('index');

    Route::group(['prefix' => 'patient','middleware' => 'license'], function (){
        Route::get('/', [PatientController::class, 'index'])->name('patients');
        Route::get('/view/{id}', [PatientController::class, 'view'])->name('patient.view');
        Route::get('/update/{patient_id}', [PatientController::class, 'edit'])->name('patient.edit');
    });

    Route::get('/profile', [HospitalController::class, 'profile'])->name('profile');

    Route::group(['prefix' => 'web-api'], function (){
        // update hospital profile
        Route::get('notification/list',[HospitalController::class, 'notificationList'])->name('notification.list');
        Route::post('/hospital-update', [HospitalController::class, 'update'])->name('hospital.update');
    });
});

Route::group(['prefix' => 'hospital/web-api/patient', 'middleware' => ['auth']], function (){
    Route::get('/get/{id}', [PatientController::class, 'getPatient'])->name('patient.get');
    Route::get('/list', [PatientController::class, 'getPatientList']);
    Route::post('/create', [PatientController::class, 'savePatient']);
    Route::delete('/delete/{patient_id}', [PatientController::class, 'deletePatient']);
    Route::post('/update', [PatientController::class, 'updatePatient']);
    Route::post('/transfer', [PatientController::class, 'transferPatient']);
});
