<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->namespace('admin')->group(function () {
    Route::redirect('/', '/admin/login');
    Route::match(['get', 'post'], '/login', 'UserController@login')->name('admin.login');
    Route::match(['get', 'post'], '/logout', 'UserController@logout')->name('admin.logout');

    Route::middleware(['admin'])->group(function () {
        Route::get('/index', 'IndexController@index')->name('admin.index');
    });
});

Route::get('/', 'IndexController@index')->name('user.index');
Route::redirect('/index', '/');
Route::get('/login', 'UserController@index')->name('user.login.form');

Route::prefix('user')->group(function () {
    Route::post('/login', 'UserController@Login')->name('user.login');
    Route::post('/signin', 'UserController@Signin')->name('user.signin');
    Route::post('/logout', 'UserController@logout')->name('user.logout');
    Route::get('/activation/{key}', 'UserController@activation')->name('user.activation');
});

Route::prefix('cart')->group(function () {
    Route::get('/', 'ShoppingCartController@index')->name('cart');
    Route::post('/add', 'ShoppingCartController@add')->name('cart.add');
    Route::patch('/update/{rowId}', 'ShoppingCartController@update')->name('cart.update');
    Route::delete('/delete/{rowId}', 'ShoppingCartController@delete')->name('cart.delete');
    Route::delete('/clear', 'ShoppingCartController@clear')->name('cart.clear');
});

Route::prefix('order')->group(function () {
    Route::get('/', 'OrderController@index')->name('order');
    Route::get('/{order_id}', 'OrderController@detail')->name('order.detail');
    Route::get('/payment', 'OrderController@complate')->name('order.complate');
    Route::post('/payment', 'OrderController@payment')->name('order.payment');
});

Route::get('/{category_name}', 'CategoryController@index')->name('category');
Route::get('/{category_name}/{product_name}', 'CategoryController@product')->name('category.product');
