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

Route::get('covid-case', 'API\CurlCovidController@all');
Route::get('covid-case/summary', 'API\CurlCovidController@summary');
Route::get('covid-case/{id}', 'API\CurlCovidController@country');