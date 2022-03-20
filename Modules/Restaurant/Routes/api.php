<?php
use Illuminate\Http\Request;

Route::get('/restaurant/list', [\Modules\Restaurant\Http\Controllers\ApiController::class, 'listRestaurants']);

Route::group(['middleware' => 'auth:sanctum'], function (){

});
