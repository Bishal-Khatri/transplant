<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/grocery/items', [\Modules\Grocery\Http\Controllers\ApiController::class, 'listItems']);
Route::get('/grocery/item/{id}', [\Modules\Grocery\Http\Controllers\ApiController::class, 'show']);

Route::group(['middleware' => 'auth:sanctum'], function (){

});
