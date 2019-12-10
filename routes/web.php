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

// Home Login
Route::get('/', 'HomeController@index')->name('/');

// Unauthenticated page
Route::get('unauthenticated', 'Errors\ErrorController@unauthenticated')->name('unauthenticated');

// Authentication routes
Auth::routes();

//External user registration
Route::group(['middleware' => 'signed'], function() {
    Route::get('register-external', 'Auth\RegisterController@showExternalRegistrationForm')->name('reg-ext');
    Route::post('register-external', 'Auth\RegisterController@registerExternal')->name('reg-ext');
}); 

// External user login (middleware in controller)
Route::get('login-external', 'Auth\LoginController@showExternalLogin')->name('login-ext');
Route::post('login-external', 'Auth\LoginController@externalLogin')->name('login-ext');

// External user show
Route::get('external-user', 'ExternalUsers\ExternalUserController@home')->name('ext-home')->middleware('auth:external');

// Users
Route::resource('user', 'Users\UserController')->only(['index', 'destroy'])->middleware('can:administrate');

Route::group(['middleware' => 'auth'], function() {
    // Members
    Route::resource('member', 'Members\MemberController')->except(['edit', 'create']);
    Route::post('invite', 'Members\MemberController@invite')->name('invite');
    Route::delete('member/{id}/invite', 'Members\MemberController@deleteInvite')->name('invite.delete');
    
    // Contributions
    Route::resource('contribution', 'Contributions\ContributionController')->except(['create', 'edit']);
    
    // Activities
    Route::resource('activity', 'Activities\ActivityTypeController')->only(['index', 'update', 'store']);
    
    // Statistics
    Route::get('statistics', 'Statistics\StatisticsController@index')->name('statistics');
    
    // Emails
    Route::group(['prefix' => 'email/send'], function() {
        Route::get('{id?}', 'Emails\SendEmailController@show')->name('send.mail.show');
        Route::post('', 'Emails\SendEmailController@send')->name('send.mail.send');
    });
    Route::resource('email', 'Emails\EmailController')->only(['index', 'show', 'destroy']);
    
    // TestController
    Route::group(['prefix' => 'test'], function () {
        Route::get('show', 'TestController@testPage');
        Route::get('error', 'TestController@error');
        Route::delete('delete/{id}', 'TestController@destroyTest');
    });
});


