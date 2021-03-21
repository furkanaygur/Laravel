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

Route::get('/', 'IndexController@index')->name('index');
Route::get('/category/{category_name}', 'CategoryController@index')->name('category');
Route::get('/product/{product}', 'ProductController@index')->name('product');
Route::post('/search', 'ProductController@search_product')->name('search_product');
Route::get('/search', 'ProductController@search_product')->name('search_product');

Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/payment', 'PaymentController@index')->name('payment');
Route::get('/orders', 'OrdersController@index')->name('orders');
Route::get('/orders/{id}', 'OrdersController@order_detail')->name('order_detail');

Route::prefix('users')->group(function () {
    Route::get('/login', 'UsersController@Login')->name('users.Login');
    Route::get('/signin', 'UsersController@signin_form')->name('users.signin_form');
    Route::post('/signin', 'UsersController@signin');
});
