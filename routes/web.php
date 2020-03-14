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
Route::get('/seeker/get/{id}', 'Tables\SeekersController@seekerSingle');
Route::post('/seeker', 'Tables\SeekersController@seekerAdd');
Route::put('/seeker/edit', 'Tables\SeekersController@seekerEdit');
Route::put('/seeker/delete', 'Tables\SeekersController@seekerDelete')->name('seeker.delete');
Route::post('/seeker/my_profile', 'Tables\SeekersController@myProfileUpdate')->name('seeker.seeker_my_profile');

Route::get('/provider_list', 'Tables\ProvidersController@providerList');
Route::get('/provider/get/{id}', 'Tables\ProvidersController@providerSingle');
Route::post('/provider', 'Tables\ProvidersController@providerAdd');
Route::put('/provider/edit', 'Tables\ProvidersController@providerEdit');
Route::put('/provider/delete', 'Tables\ProvidersController@providerDelete')->name('provider.delete');
Route::put('/provider/enable', 'Tables\ProvidersController@providerEnable')->name('provider.enable');
Route::post('/provider/my_profile', 'Tables\ProvidersController@myProfileUpdate')->name('provider.my_profile');
Route::post('/provider/quick-job-request', 'Tables\ProvidersController@quickJobRequestAdd');
Route::post('/provider/post-job', 'Tables\ProvidersController@postJobAdd');
Route::put('/provider/post-job', 'Tables\ProvidersController@postJobEdit');

Route::get('/quick_job_list/get/{id}', 'Tables\QuickListingsController@getQuickJobListingSingle');
Route::put('/quick_job_list/put', 'Tables\QuickListingsController@updateQuickJobListing');
Route::put('/quick_job_list/delete', 'Tables\QuickListingsController@deleteQuickJobListing');

Route::get('/job_listing/all', 'Tables\RegularListingsController@getJobListingAll');

Route::get('/chat/{id}', 'Tables\ChatsController@getChats');
Route::post('/chat/send', 'Tables\ChatsController@sendMessage');

Route::get('mail/send', 'Tables\NotificationsController@send');

Route::post('send/positive', 'Tables\NotificationsController@sendPositive');
Route::post('send/negative', 'Tables\NotificationsController@sendNegative');

Route::get('/apply/quick_job/{id}', 'Tables\QuickListingsController@applyQuickJob');
Route::get('/apply/listing_job/{id}', 'Tables\RegularListingsController@applyRegularJob');
Route::post('/apply/quick_job', 'Tables\QuickListingsController@applyQuickJobSend');
Route::post('/apply/listing_job', 'Tables\RegularListingsController@applyRegularJobSend');

Route::post('/cancel_quick/{id}', 'Tables\QuickListingsController@cancelQuick')->name('cancel_quick');
Route::post('/cancel_listing/{id}', 'Tables\RegularListingsController@cancellisting')->name('cancel_listing');

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
        Route::get('/job-listing', 'ProviderPagesController@jobListing')->name('job-listing');
        Route::get('/job-listing/get/{id}', 'ProviderPagesController@jobListingSingle')->name('job-listing-single');
        Route::get('/quick-job-list', 'ProviderPagesController@quickJobListing')->name('quick-job-listing');
        Route::get('/my-profile', 'ProviderPagesController@myProfile');
        Route::get('/my-schedule', 'ProviderPagesController@mySchedule');
        Route::get('/new-job-listing', 'ProviderPagesController@newJobListing');
        Route::get('/post-job', 'ProviderPagesController@postJob');
        Route::get('/quick-job-request', 'ProviderPagesController@quickJobRequest');
        Route::get('/quick-job-request/{id}', 'ProviderPagesController@quickJobRequestAdd');
        Route::get('/view-applications', 'ProviderPagesController@viewApplications');
    });
});

Route::middleware('seeker')->group(function(){
    Route::prefix('seeker')->group(function () {
        Route::get('/', 'SeekerDashboardController@index')->name('seeker.dashboard');
        Route::get('/find-jobs', 'SeekerPagesController@findJobs');
        Route::get('/my-calendar', 'SeekerPagesController@myCalendar');
        Route::get('/my-schedule', 'SeekerPagesController@mySchedule');
        Route::get('/my-profile', 'SeekerPagesController@myProfile');
        Route::get('/ongoing-applications', 'SeekerPagesController@ongoingApplications')->name('ongoing-applications');
    });
});