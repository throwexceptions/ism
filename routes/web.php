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
    Route::get('/home', 'DashboardController@index')->name('home');

    Route::get('/purchase', 'PurchaseInfoController@index')->name('purchase');
    Route::post('/purchase/table', 'PurchaseInfoController@table')->name('purchase.table');
    Route::get('/purchase/create', 'PurchaseInfoController@create')->name('purchase.create');
    Route::get('/purchase/detail/{id}', 'PurchaseInfoController@show')->name('purchase.detail');
    Route::post('/purchase/update', 'PurchaseInfoController@update')->name('purchase.update');
    Route::post('/purchase/store', 'PurchaseInfoController@store')->name('purchase.store');
    Route::post('/purchase/destory', 'PurchaseInfoController@destory')->name('purchase.destory');
    Route::get('/purchase/view/{id}', 'PurchaseInfoController@show')->name('purchase.view');

    Route::get('/vendor', 'VendorController@index')->name('vendor');
    Route::post('/vendor/table', 'VendorController@table')->name('vendor.table');
    Route::get('/vendor/create', 'VendorController@create')->name('vendor.create');
    Route::get('/vendor/detail/{id}', 'VendorController@show')->name('vendor.detail');
    Route::post('/vendor/destroy', 'VendorController@destroy')->name('vendor.destroy');
    Route::get('/vendor/view/{id}', 'VendorController@show')->name('vendor.view');

    Route::get('/inquiry', 'InquiryController@index')->name('inquiry');
    Route::post('/inquiry/table', 'InquiryController@table')->name('inquiry.table');
    Route::post('/inquiry/destroy', 'InquiryController@destory')->name('inquiry.destory');

    Route::get('/customer', 'CustomerController@index')->name('customer');
    Route::post('/customer/table', 'CustomerController@table')->name('customer.table');
    Route::get('/customer/create', 'CustomerController@create')->name('customer.create');
    Route::get('/customer/detail/{id}', 'CustomerController@show')->name('customer.detail');
    Route::get('/customer/view/{id}', 'CustomerController@show')->name('customer.view');

    Route::get('/products', 'ProductController@index')->name('products');
    Route::post('/products/table', 'ProductController@table')->name('product.table');
    Route::get('/products/create', 'ProductController@create')->name('product.create');
    Route::get('/product/detail/{id}', 'ProductController@show')->name('product.detail');
    Route::get('/product/view/{id}', 'ProductController@show')->name('product.view');

    Route::get('/supply', 'SupplyController@index')->name('supply');
    Route::post('/supply/table', 'SupplyController@table')->name('supply.table');
    Route::get('/supply/detail/{id}', 'SupplyController@show')->name('supply.detail');
    Route::get('/supply/view/{id}', 'SupplyController@show')->name('supply.view');
    Route::get('/supply/create', 'SupplyController@create')->name('supply.create');

    Route::get('/sales', 'SalesOrderController@index')->name('sales');
    Route::get('/sales/create', 'SalesOrderController@create')->name('sales.create');
    Route::post('/sales/table', 'SalesOrderController@table')->name('sales.table');
    Route::get('/sales/view/{id}', 'SalesOrderController@show')->name('sales.view');

    Route::get('/users', 'UserController@index')->name('users');
    Route::get('/users/create', 'UserController@create')->name('user.create');
    Route::post('/users/table', 'UserController@table')->name('user.table');
});