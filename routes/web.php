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
    return redirect('login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'AdminController@index')->name('home');

    Route::post('/product/table', 'ProductController@table');
    Route::post('/product/store', 'ProductController@store');
    Route::post('/product/update', 'ProductController@update');

    Route::post('/receive/table', 'ReceiveController@table');

    Route::post('/shipment/table', 'ShipmentController@table');

    Route::post('/customer/table', 'CustomerController@table');

    Route::post('/user/table', 'UsersController@table');
    Route::post('/user/store', 'UsersController@store');
    Route::post('/user/update', 'UsersController@update');
    Route::post('/user/destroy', 'UsersController@destroy');
    Route::post('/user/abilities', 'UsersController@getAbilities');
    Route::post('/user/abilities/own', 'UsersController@myAbilities');
    Route::post('/user/abilities/update', 'UsersController@updateAbilities');

    Route::post('/log/table', 'LogController@table');
});