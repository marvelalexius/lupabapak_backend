<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('/google/login', 'AuthController@loginGoogle');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::get('products', 'ProductController@index');

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('wishlist', 'WishlistController');
    Route::post('transaction', 'TransactionController@store');
    Route::resource('cart', 'CartController');
});

Route::prefix('payment')->namespace('Paypal')->name('paypal.')->group(function() {
    Route::get('transaction/{reservation_id}', 'TransactionController@payment')->name('transaction');
    Route::post('complete', 'TransactionController@getOrder')->name('complete');
});
