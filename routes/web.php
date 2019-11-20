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

// Home
Route::get('/', 'HomeController@index')->name('/');

// Authentication routes
Auth::routes();
Route::get('register-external', 'Auth\RegisterController@showExternalRegistrationForm')->name('reg-ext')->middleware('signed');

// Members
Route::resource('member', 'Members\MemberController');
Route::post('member-company', 'Members\MemberController@storeCompany')->name('storeCompany');

// External users
Route::resource('external-user', 'ExternalUsers\ExternalUserController')->only('show');

// TestController
Route::group(['prefix' => 'test'], function () {
    Route::get('show', 'TestController@testPage');
    Route::delete('delete/{id}', 'TestController@destroyTest');
    Route::post('member-create', 'TestController@postFormTest');
    Route::get('mail', 'TestController@sendMail');
    Route::get('view-mail', 'TestController@viewMail');
});

