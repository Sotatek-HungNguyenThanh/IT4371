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

    Route::get('/list-user', 'Admin\AdminController@showListUserPage');

    Route::get('/list-staff', 'Admin\AdminController@showListStaffPage');

    Route::get('update-status-user/{id}', 'Admin\AdminController@updateStatusUser');

    Route::get('update-status-staff/{id}', 'Admin\AdminController@updateStatusStaff');
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

    Route::get('add-money', 'Staff\StaffController@getAddMoneyPage');

    Route::post('/deposit-money-account', 'Staff\StaffController@depositMoneyAccount');

    Route::get('/transfer', 'Staff\StaffController@getTransferPage');

    Route::post('create-transfer-transaction', 'Staff\StaffController@createTransferTransaction');

    Route::post('add-other-customer', 'Staff\StaffController@addOtherCustomer');

    Route::get('add-other-customer', 'Staff\StaffController@getAddOtherCustomerPage');

    Route::get('list-user', 'Staff\StaffController@getListUserPage');

    Route::get('update-status-user/{id}', 'Staff\StaffController@updateStatusUser');

});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'UserController@showHomePage');

    Route::get('/logout', 'LoginController@logout');

    Route::get('/manage-password', 'AccountController@getManagePasswordPage');

    Route::get('/update-info', 'AccountController@getUpdateInfoPage');

    Route::post('update-password', 'AccountController@updatePassword');

    Route::post('update-avatar', 'AccountController@updateAvatar');

    Route::post('get-account-info', 'AccountController@getAccountInfo');

    Route::post('update-account-info', 'AccountController@updateAccountInfo');

    Route::post('get-bank-account-info', 'AccountController@getBankAccountInfo');

    Route::get('pay', 'UserController@getPayPage');

    Route::get('transfer', 'UserController@getTransferPage');

    Route::get('history', 'UserController@getHistoryPage');

    Route::post('create-pay-transaction', 'UserController@createPayTransaction');

    Route::post('create-transfer-transaction', 'UserController@createTransferTransaction');

    Route::post('get-history-transaction', 'UserController@getHistoryTransaction');

    Route::get('add-money', 'UserController@getAddMoneyPage');

    Route::post('deposit-money-account', 'UserController@depositMoneyAccount');
});

Route::get('test', 'HomeController@test');