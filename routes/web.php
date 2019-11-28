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
Route::post('register-external', 'Auth\RegisterController@registerExternal')->name('reg-ext')->middleware('signed');
Route::get('login-external', 'Auth\LoginController@showExternalLogin')->name('login-ext');
Route::post('login-external', 'Auth\LoginController@externalLogin')->name('login-ext');


// Members
Route::resource('member', 'Members\MemberController')->except(['edit']);
Route::post('member-company', 'Members\MemberController@storeCompany')->name('storeCompany');
Route::post('invite', 'Members\MemberController@invite')->name('invite');

// External users
Route::get('external-user', 'ExternalUsers\ExternalUserController@home')->name('ext-home')->middleware('auth:external');

// TestController
Route::group(['prefix' => 'test'], function () {
    Route::get('show', 'TestController@testPage');
    Route::delete('delete/{id}', 'TestController@destroyTest');
    Route::post('member-create', 'TestController@postFormTest');
    Route::get('mail', 'TestController@sendMail');
    Route::get('view-mail', 'TestController@viewMail');
});

