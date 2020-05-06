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

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', 'Auth\Admin\LoginController@showLoginForm')->name('admin.login.form');
    Route::post('login', 'Auth\Admin\LoginController@login')->name('admin.login');
    Route::post('logout', 'Auth\Admin\LoginController@logout')->name('admin.logout');
});

Auth::routes();

Route::get('home', 'HomeController@index');

Route::resource('products', 'WebProductController')->middleware('auth:admin_web');

Route::get('transaction/{transaction_code}/detail', 'TransactionController@get')->name('transaction.detail');

Route::get('auth/google/redirect', 'Auth\LoginController@redirectToProvider')->name('google.login');
Route::get('auth/google/callback', 'Auth\LoginController@handleProviderCallback');
