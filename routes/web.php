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

Route::get('/seeker_list', 'Tables\SeekersController@seekerList');
Route::get('/seeker/{id}', 'Tables\SeekersController@seekerSingle');
Route::post('/seeker', 'Tables\SeekersController@seekerAdd');
Route::put('/seeker/edit', 'Tables\SeekersController@seekerEdit');
Route::put('/seeker/delete', 'Tables\SeekersController@seekerDelete')->name('seeker.delete');

Route::get('/provider_list', 'Tables\ProvidersController@providerList');
Route::get('/provider/{id}', 'Tables\ProvidersController@providerSingle');
Route::post('/provider', 'Tables\ProvidersController@providerAdd');
Route::put('/provider/edit', 'Tables\ProvidersController@providerEdit');
Route::put('/provider/delete', 'Tables\ProvidersController@providerDelete')->name('provider.delete');
Route::put('/provider/enable', 'Tables\ProvidersController@providerEnable')->name('provider.enable');

Route::get('/chat/{id}', 'Tables\ChatsController@getChats');
Route::post('/chat/send', 'Tables\ChatsController@sendMessage');

Route::get('mail/send', 'Tables\NotificationsController@send');

Route::middleware('admin')->group(function(){
    Route::prefix('admin')->group(function () {
        Route::get('/', 'AdminDashboardController@index')->name('admin.dashboard');
        Route::get('/employment-rate', 'AdminPagesController@employmentRate');
        Route::get('/job-providers', 'AdminPagesController@jobProviders');
        Route::get('/job-seekers', 'AdminPagesController@jobSeekers');
        Route::get('/manage-announcements', 'AdminPagesController@manageAnnouncements');
        Route::get('/manage-listings', 'AdminPagesController@manageListings');
        Route::get('/my-events', 'AdminPagesController@myEvents');
        Route::get('/recent-listings', 'AdminPagesController@recentListings');
        Route::get('/user-activity', 'AdminPagesController@userActivity');
        Route::get('/website-administrators', 'AdminPagesController@websiteAdministrators');
    });    
});

Route::middleware('provider')->group(function(){
    Route::prefix('provider')->group(function () {
        Route::get('/', 'ProviderDashboardController@index')->name('provider.dashboard');
        Route::get('/job-listing', 'ProviderPagesController@jobListing');
        Route::get('/my-profile', 'ProviderPagesController@myProfile');
        Route::get('/my-schedule', 'ProviderPagesController@mySchedule');
        Route::get('/new-job-listing', 'ProviderPagesController@newJobListing');
        Route::get('/post-job', 'ProviderPagesController@postJob');
        Route::get('/quick-job-request', 'ProviderPagesController@quickJobRequest');
        Route::get('/view-applications', 'ProviderPagesController@viewApplications');
    });
});

Route::middleware('seeker')->group(function(){
    Route::prefix('seeker')->group(function () {
        Route::get('/', 'SeekerDashboardController@index')->name('seeker.dashboard');
        Route::get('/full-time', 'SeekerPagesController@fullTime');
        Route::get('/my-calendar', 'SeekerPagesController@myCalendar');
        Route::get('/my-schedule', 'SeekerPagesController@mySchedule');
        Route::get('/my-profile', 'SeekerPagesController@myProfile');
        Route::get('/ongoing-applications', 'SeekerPagesController@ongoingApplications');
        Route::get('/part-time', 'SeekerPagesController@partTime');
    });
});