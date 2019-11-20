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

Auth::routes();
Route::get('register-external', 'Auth\ExternalRegisterController@register')->name('reg-ext')->middleware('signed');

Route::get('/', 'HomeController@index')->name('/');

// Members
Route::resource('member', 'Members\MemberController');
Route::post('member-company', 'Members\MemberController@storeCompany')->name('storeCompany');


// TestController
Route::group(['prefix' => 'test'], function () {
    Route::get('show', 'TestController@testPage');
    Route::delete('delete/{id}', 'TestController@destroyTest');
    Route::post('member-create', 'TestController@postFormTest');
    Route::get('mail', 'TestController@sendMail');
});

