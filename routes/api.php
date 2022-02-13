<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers'], function()
{ 

	Route::get('cities', 'ApiController@getAllCities');
	Route::get('city/{id}', 'ApiController@getCity');

	Route::get('buses', 'ApiController@getAllBuses');
	Route::get('bus/{id}', 'ApiController@getBus');

});