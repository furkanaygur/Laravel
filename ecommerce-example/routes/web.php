<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;


Route::prefix('order')->group(function () {
    Route::get('/payment', 'OrderController@complate')->name('order.complate');
    Route::get('/', 'OrderController@index')->name('order');
    Route::get('/{order_id}', 'OrderController@detail')->name('order.detail');
    Route::post('/payment', 'OrderController@payment')->name('order.payment');
});

Route::prefix('admin')->namespace('admin')->group(function () {
    Route::redirect('/', '/admin/login');
    Route::match(['get', 'post'], '/login', 'LoginController@login')->name('admin.login');
    Route::match(['get', 'post'], '/logout', 'LoginController@logout')->name('admin.logout');

    Route::middleware(['admin'])->group(function () {
        Route::redirect('/index', '/admin/');
        Route::get('/', 'IndexController@index')->name('admin.index');

        Route::get('/users', 'UserController@index')->name('admin.users');
        Route::prefix('user')->group(function () {
            Route::match(['get', 'post'], '/{user_id}', 'UserController@update')->name('admin.user-update');
        });

        Route::get('/products', 'ProductController@index')->name('admin.products');
        Route::redirect('/product', '/admin/products');
        Route::prefix('product')->group(function () {
            Route::match(['get', 'post'], '/add', 'ProductController@add_product')->name('admin.add-product');
            Route::match(['get', 'post'], '/{product_id?}', 'ProductController@update')->name('admin.product-update');
        });

        Route::get('/orders', 'OrderController@index')->name('admin.orders');
        Route::prefix('order')->group(function () {
            Route::match(['get', 'post'], '/{order_id}', 'OrderController@update')->name('admin.order-update');
        });

        Route::get('/categories', 'CategoryController@index')->name('admin.categories');
        Route::prefix('category')->group(function () {
            Route::match(['get', 'post'], '/add', 'CategoryController@add_category')->name('admin.add-category');
            Route::match(['get', 'post'], '/{categorry_id}', 'CategoryController@update')->name('admin.category-update');
        });
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


Route::get('/{category_name}', 'CategoryController@index')->name('category');
Route::get('/{category_name}/{product_name}', 'CategoryController@product')->name('category.product');
