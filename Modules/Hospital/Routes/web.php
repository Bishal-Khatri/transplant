<?php

use Modules\Hospital\Http\Controllers\HospitalController;

//Route::prefix('hospital')->middleware(['auth', 'hospital'])->group(function() {
Route::group(['prefix' => 'hospital', 'middleware' => ['auth', 'hospital'], 'as' => 'hospital.'],function() {
    Route::get('/', [HospitalController::class, 'index'])->name('index');

    Route::group(['middleware' => 'license'], function (){
        Route::get('/patient', [HospitalController::class, 'patients'])->name('patients');
    });

    Route::get('/profile', [HospitalController::class, 'profile'])->name('profile');
});
