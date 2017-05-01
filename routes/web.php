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

    Route::get('/manage-password', 'Admin\AccountController@getManagePasswordPage');

    Route::get('/update-info', 'Admin\AccountController@getUpdateInfoPage');

    Route::post('update-account-info', 'Admin\AccountController@updateAccountInfo');

    Route::post('get-account-info', 'Admin\AccountController@getAccountInfo');

});

Route::group(['prefix' => 'staff', 'middleware' => 'staff'], function () {

    Route::get('/home', 'Staff\HomeController@showHomePage');

    Route::get('/logout', 'Staff\LoginController@logout');

    Route::post('update-password', 'Staff\AccountController@updatePassword');

    Route::post('update-avatar', 'Staff\AccountController@updateAvatar');

    Route::get('/manage-password', 'Staff\AccountController@getManagePasswordPage');

    Route::get('/update-info', 'Staff\AccountController@getUpdateInfoPage');

    Route::post('update-account-info', 'Staff\AccountController@updateAccountInfo');

    Route::post('get-account-info', 'Staff\AccountController@getAccountInfo');

    Route::get('create-customer', 'Staff\StaffController@getCreateCustomerPage');

    Route::post('create-customer', 'Staff\StaffController@createCustomer');

});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@showHomePage');

    Route::get('/logout', 'LoginController@logout');

    Route::get('/manage-password', 'AccountController@getManagePasswordPage');

    Route::get('/update-info', 'AccountController@getUpdateInfoPage');

    Route::post('update-password', 'AccountController@updatePassword');

    Route::post('update-avatar', 'AccountController@updateAvatar');

    Route::post('get-account-info', 'AccountController@getAccountInfo');

    Route::post('update-account-info', 'AccountController@updateAccountInfo');

    Route::post('get-bank-account-info', 'AccountController@getBankAccountInfo');

});

Route::get('test', 'HomeController@test');