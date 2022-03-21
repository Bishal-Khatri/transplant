<?php
use Illuminate\Http\Request;

Route::get('/restaurant/list', [\Modules\Restaurant\Http\Controllers\ApiController::class, 'listRestaurants']);
Route::post('/restaurant/show', [\Modules\Restaurant\Http\Controllers\ApiController::class, 'show']);
Route::group(['middleware' => 'auth:sanctum'], function (){

});
