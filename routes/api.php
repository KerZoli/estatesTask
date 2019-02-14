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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/developers', 'DevelopersController@index');
Route::get('/countries', 'CitiesController@listCountries');

Route::post('/list', 'ListController@store');
Route::get('/list', 'ListController@index');
Route::get('/list/{id}', 'ListController@show');
