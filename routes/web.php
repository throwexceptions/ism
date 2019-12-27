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
    Route::get('/purchase/view/{id}', 'PurchaseInfoController@show')->name('purchase.view');
    Route::get('/purchase/detail/{id}', 'PurchaseInfoController@show')->name('purchase.detail');
    Route::post('/purchase/update', 'PurchaseInfoController@update')->name('purchase.update');
    Route::post('/purchase/store', 'PurchaseInfoController@store')->name('purchase.store');
    Route::post('/purchase/destroy', 'PurchaseInfoController@destroy')->name('purchase.destroy');

    Route::get('/sales', 'SalesOrderController@index')->name('sales');
    Route::get('/sales/create', 'SalesOrderController@create')->name('sales.create');
    Route::post('/sales/table', 'SalesOrderController@table')->name('sales.table');
    Route::get('/sales/view/{id}', 'SalesOrderController@show')->name('sales.view');
    Route::get('/sales/detail/{id}', 'SalesOrderController@show')->name('sales.detail');
    Route::post('/sales/update', 'SalesOrderController@update')->name('sales.update');
    Route::post('/sales/store', 'SalesOrderController@store')->name('sales.store');
    Route::post('/sales/destroy', 'SalesOrderController@destroy')->name('sales.destroy');

    Route::get('/vendor', 'VendorController@index')->name('vendor');
    Route::post('/vendor/table', 'VendorController@table')->name('vendor.table');
    Route::get('/vendor/create', 'VendorController@create')->name('vendor.create');
    Route::get('/vendor/detail/{id}', 'VendorController@show')->name('vendor.detail');
    Route::get('/vendor/view/{id}', 'VendorController@show')->name('vendor.view');
    Route::post('/vendor/list', 'VendorController@getList')->name('vendor.list');
    Route::post('/vendor/update', 'VendorController@update')->name('vendor.update');
    Route::post('/vendor/store', 'VendorController@store')->name('vendor.store');
    Route::post('/vendor/destroy', 'VendorController@destroy')->name('vendor.destroy');

    Route::get('/inquiry', 'InquiryController@index')->name('inquiry');
    Route::post('/inquiry/table', 'InquiryController@table')->name('inquiry.table');
    Route::post('/inquiry/destroy', 'InquiryController@destroy')->name('inquiry.destroy');

    Route::get('/customer', 'CustomerController@index')->name('customer');
    Route::post('/customer/table', 'CustomerController@table')->name('customer.table');
    Route::get('/customer/detail/{id}', 'CustomerController@show')->name('customer.detail');
    Route::get('/customer/view/{id}', 'CustomerController@show')->name('customer.view');
    Route::post('/customer/list', 'CustomerController@getList')->name('customer.list');
    Route::get('/customer/create', 'CustomerController@create')->name('customer.create');
    Route::post('/customer/update', 'CustomerController@update')->name('customer.update');
    Route::post('/customer/store', 'CustomerController@store')->name('customer.store');
    Route::post('/customer/destroy', 'CustomerController@destroy')->name('customer.destroy');

    Route::get('/products', 'ProductController@index')->name('products');
    Route::post('/products/table', 'ProductController@table')->name('product.table');
    Route::get('/products/create', 'ProductController@create')->name('product.create');
    Route::get('/product/detail/{id}', 'ProductController@show')->name('product.detail');
    Route::get('/product/view/{id}', 'ProductController@show')->name('product.view');
    Route::post('/product/list', 'ProductController@getList')->name('product.list');
    Route::post('/product/store', 'ProductController@store')->name('product.store');
    Route::post('/product/update', 'ProductController@update')->name('product.update');
    Route::post('/product/image/upload', 'ProductController@imageUpload')->name('product.image.upload');
    Route::post('/product/destroy', 'ProductController@destroy')->name('product.destroy');
    Route::post('/category/destroy', 'CategoryController@destroy')->name('category.delete');
    Route::post('/category/store', 'CategoryController@store')->name('category.store');

    Route::get('/supply', 'SupplyController@index')->name('supply');
    Route::post('/supply/table', 'SupplyController@table')->name('supply.table');

    Route::get('/users', 'UserController@index')->name('users');
    Route::post('/users/table', 'UserController@table')->name('user.table');
    Route::get('/user/detail/{id}', 'UserController@show')->name('user.detail');
    Route::get('/user/create', 'UserController@create')->name('user.create');
    Route::post('/user/store', 'UserController@store')->name('user.store');
    Route::post('/user/update', 'UserController@update')->name('user.update');
    Route::post('/user/destroy', 'UserController@destroy')->name('user.destroy');
    Route::post('/user/change/pass', 'UserController@changePass')->name('user.change.pass');

    Route::get('/role', 'SecurityController@roles')->name('role');
    Route::post('/role/table', 'SecurityController@table')->name('role.table');
    Route::get('/role/create', 'SecurityController@create')->name('role.create');
    Route::get('/role/detail/{id}', 'SecurityController@show')->name('role.detail');
    Route::post('/role/store', 'SecurityController@store')->name('role.store');
    Route::post('/role/abilities', 'SecurityController@update')->name('role.abilities');
    Route::post('/role/destroy', 'SecurityController@destroy')->name('role.destroy');\

    Route::get('/orderform', 'OrderFormController@index')->name('orderform');
    Route::post('/orderform/table', 'OrderFormController@table')->name('orderform.table');
    Route::get('/orderform/create', 'OrderFormController@create')->name('orderform.create');
    Route::post('/orderform/store', 'OrderFormController@store')->name('orderform.store');
    Route::post('/orderform/update', 'OrderFormController@update')->name('orderform.update');
    Route::post('/orderform/destroy', 'OrderFormController@destroy')->name('orderform.destroy');
    Route::get('/orderform/view/{id}', 'OrderFormController@show')->name('orderform.view');
});