<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('admin')->group(function(){
    Route::get('/admin', 'AdminDashboardController@index')->name('admin.dashboard');
});

Route::middleware('provider')->group(function(){
    Route::get('/provider', 'ProviderDashboardController@index')->name('provider.dashboard');
});

Route::middleware('seeker')->group(function(){
    Route::get('/seeker', 'SeekerDashboardController@index')->name('seeker.dashboard');
});