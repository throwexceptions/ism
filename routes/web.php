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
    Route::post('/home/instock', 'DashboardController@inStock')->name('home.instock');
    Route::post('/home/outofstock', 'DashboardController@outOfStock')->name('home.outofstock');
    Route::post('/home/returned', 'DashboardController@returnedSO')->name('home.returned');
    Route::post('/home/po', 'DashboardController@orderedPO')->name('home.po');
    Route::post('/home/so', 'DashboardController@quoteSO')->name('home.so');

    Route::get('/purchase', 'PurchaseInfoController@index')->name('purchase')->middleware('can:purchase_order');
    Route::get('/purchase/create', 'PurchaseInfoController@create')->name('purchase.create')->middleware('can:purchase_order_create');
    Route::get('/purchase/view/{id}', 'PurchaseInfoController@show')->name('purchase.view')->middleware('can:purchase_order_retrieve');
    Route::get('/purchase/detail/{id}', 'PurchaseInfoController@show')->name('purchase.detail')->middleware('can:purchase_order_update');
    Route::post('/purchase/destroy', 'PurchaseInfoController@destroy')->name('purchase.destroy')->middleware('can:purchase_order_delete');
    Route::post('/purchase/table', 'PurchaseInfoController@table')->name('purchase.table');
    Route::post('/purchase/update', 'PurchaseInfoController@update')->name('purchase.update');
    Route::post('/purchase/store', 'PurchaseInfoController@store')->name('purchase.store');
    Route::post('/purchase/status/update', 'PurchaseInfoController@updateStatus')->name('purchase.status.update');
    Route::get('/purchase/print/{id}', 'PurchaseInfoController@printable')->name('purchase.print');
    Route::get('/purchase/preview/{id}', 'PurchaseInfoController@previewPO')->name('purchase.preview');

    Route::get('/sales', 'SalesOrderController@index')->name('sales')->middleware('can:sales_order');
    Route::get('/sales/create', 'SalesOrderController@create')->name('sales.create')->middleware('can:sales_order_create');
    Route::get('/sales/view/{id}', 'SalesOrderController@show')->name('sales.view')->middleware('can:sales_order_retrieve');
    Route::get('/sales/detail/{id}', 'SalesOrderController@show')->name('sales.detail')->middleware('can:sales_order_update');
    Route::post('/sales/destroy', 'SalesOrderController@destroy')->name('sales.destroy')->middleware('can:sales_order_delete');
    Route::post('/sales/table', 'SalesOrderController@table')->name('sales.table');
    Route::post('/sales/update', 'SalesOrderController@update')->name('sales.update');
    Route::post('/sales/store', 'SalesOrderController@store')->name('sales.store');
    Route::post('/sales/status/update', 'SalesOrderController@updateStatus')->name('sales.status.update');
    Route::get('/sales/print/{id}', 'SalesOrderController@printable')->name('sales.print');
    Route::get('/purchase/quote/{id}', 'SalesOrderController@quote')->name('sales.quote');
    Route::get('/purchase/deliver/{id}', 'SalesOrderController@deliver')->name('sales.deliver');
    Route::get('/sales/preview/{id}', 'SalesOrderController@previewSO')->name('sales.preview');

    Route::get('/vendor', 'VendorController@index')->name('vendor')->middleware('can:vendors');
    Route::get('/vendor/create', 'VendorController@create')->name('vendor.create')->middleware('can:vendors_create');
    Route::get('/vendor/view/{id}', 'VendorController@show')->name('vendor.view')->middleware('can:vendors_retrieve');
    Route::get('/vendor/detail/{id}', 'VendorController@show')->name('vendor.detail')->middleware('can:vendors_update');
    Route::post('/vendor/destroy', 'VendorController@destroy')->name('vendor.destroy')->middleware('can:vendors_delete');
    Route::post('/vendor/table', 'VendorController@table')->name('vendor.table');
    Route::post('/vendor/list', 'VendorController@getList')->name('vendor.list');
    Route::post('/vendor/update', 'VendorController@update')->name('vendor.update');
    Route::post('/vendor/store', 'VendorController@store')->name('vendor.store');

    Route::get('/inquiry', 'InquiryController@index')->name('inquiry');
    Route::post('/inquiry/table', 'InquiryController@table')->name('inquiry.table');
    Route::post('/inquiry/destroy', 'InquiryController@destroy')->name('inquiry.destroy');

    Route::get('/customer', 'CustomerController@index')->name('customer')->middleware('can:customer');
    Route::get('/customer/create', 'CustomerController@create')->name('customer.create')->middleware('can:customer_create');
    Route::get('/customer/view/{id}', 'CustomerController@show')->name('customer.view')->middleware('can:customer_retrieve');
    Route::get('/customer/detail/{id}', 'CustomerController@show')->name('customer.detail')->middleware('can:customer_update');
    Route::post('/customer/destroy', 'CustomerController@destroy')->name('customer.destroy')->middleware('can:customer_delete');
    Route::post('/customer/table', 'CustomerController@table')->name('customer.table');
    Route::post('/customer/list', 'CustomerController@getList')->name('customer.list');
    Route::post('/customer/update', 'CustomerController@update')->name('customer.update');
    Route::post('/customer/store', 'CustomerController@store')->name('customer.store');

    Route::get('/products', 'ProductController@index')->name('products')->middleware('can:products');
    Route::get('/products/create', 'ProductController@create')->name('product.create')->middleware('can:products_create');
    Route::get('/product/view/{id}', 'ProductController@show')->name('product.view')->middleware('can:products_retrieve');
    Route::get('/product/detail/{id}', 'ProductController@show')->name('product.detail')->middleware('can:products_update');
    Route::post('/product/destroy', 'ProductController@destroy')->name('product.destroy')->middleware('can:products_delete');
    Route::post('/product/find', 'ProductController@findProduct')->name('product.find')->middleware('can:products_update');
    Route::post('/products/table', 'ProductController@table')->name('product.table');
    Route::post('/product/list', 'ProductController@getList')->name('product.list');
    Route::post('/product/store', 'ProductController@store')->name('product.store');
    Route::post('/product/update', 'ProductController@update')->name('product.update');
    Route::post('/product/image/upload', 'ProductController@imageUpload')->name('product.image.upload');

    Route::post('/category/list', 'CategoryController@getList')->name('category.list');
    Route::post('/category/destroy', 'CategoryController@destroy')->name('category.delete')->middleware('can:products_update');
    Route::post('/category/store', 'CategoryController@store')->name('category.store')->middleware('can:products_update');

    Route::get('/supply', 'SupplyController@index')->name('supply')->middleware('can:supplies');
    Route::post('/supply/table', 'SupplyController@table')->name('supply.table');

    Route::get('/users', 'UserController@index')->name('users')->middleware('can:user_accounts');
    Route::get('/user/detail/{id}', 'UserController@show')->name('user.detail')->middleware('can:user_accounts_update');
    Route::get('/user/create', 'UserController@create')->name('user.create')->middleware('can:user_accounts_create');
    Route::post('/user/destroy', 'UserController@destroy')->name('user.destroy')->middleware('can:user_accounts_delete');
    Route::post('/user/change/pass', 'UserController@changePass')->name('user.change.pass')->middleware('can:user_accounts_change_pass');
    Route::post('/user/assign', 'UserController@assignUserRole')->name('user.assign')->middleware('can:security');
    Route::post('/users/table', 'UserController@table')->name('user.table');
    Route::post('/user/store', 'UserController@store')->name('user.store');
    Route::post('/user/update', 'UserController@update')->name('user.update');
    Route::post('/users/logo/upload', 'UserController@logoUpload')->name('user.logo.upload');
    Route::post('/user/role', 'UserController@getUserRole')->name('user.role');

    Route::get('/role', 'SecurityController@roles')->name('role')->middleware('can:security');
    Route::get('/role/create', 'SecurityController@create')->name('role.create')->middleware('can:security_create');
    Route::get('/role/detail/{id}', 'SecurityController@show')->name('role.detail')->middleware('can:products_update');
    Route::post('/role/destroy', 'SecurityController@destroy')->name('role.destroy')->middleware('can:security_delete');
    Route::post('/role/table', 'SecurityController@table')->name('role.table');
    Route::post('/role/store', 'SecurityController@store')->name('role.store');
    Route::post('/role/abilities', 'SecurityController@update')->name('role.abilities');

    Route::get('/orderform', 'OrderFormController@index')->name('orderform')->middleware('can:order_form');
    Route::get('/orderform/view/{id}', 'OrderFormController@show')->name('orderform.view')->middleware('can:order_form_retrieve');
    Route::get('/orderform/create', 'OrderFormController@create')->name('orderform.create')->middleware('can:order_form_create');
    Route::post('/orderform/destroy', 'OrderFormController@destroy')->name('orderform.destroy')->middleware('can:order_form_delete');
    Route::post('/orderform/table', 'OrderFormController@table')->name('orderform.table');
    Route::post('/orderform/store', 'OrderFormController@store')->name('orderform.store');

    Route::get('/preference', 'PreferenceController@index')->name('preference')->middleware('can:security');
    Route::post('/preference/update', 'PreferenceController@update')->name('preference.update');
});