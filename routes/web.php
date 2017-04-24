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

Route::get('admin/login', 'Admin\LoginController@showLoginForm');

Route::post('admin/login', 'Admin\LoginController@login');

Route::get('staff/login', 'Staff\LoginController@showLoginForm');

Route::post('staff/login', 'Staff\LoginController@login');

Route::get('/login', 'LoginController@showLoginForm')->name('login');

Route::post('/login', 'LoginController@login');


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::get('/home', 'Admin\HomeController@showHomePage');

    Route::get('/logout', 'Admin\LoginController@logout');

    Route::post('update-password', 'Admin\AccountController@updatePassword');

    Route::post('update-avatar', 'Admin\AccountController@updateAvatar');

});

Route::group(['prefix' => 'staff', 'middleware' => 'staff'], function () {

    Route::get('/home', 'Staff\HomeController@showHomePage');

    Route::get('/logout', 'Staff\LoginController@logout');

    Route::post('update-password', 'Staff\AccountController@updatePassword');

    Route::post('update-avatar', 'Staff\AccountController@updateAvatar');

});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@showHomePage');

    Route::get('/logout', 'LoginController@logout');

    Route::post('update-password', 'AccountController@updatePassword');

    Route::post('update-avatar', 'AccountController@updateAvatar');

});