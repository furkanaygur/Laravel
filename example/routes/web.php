<?php

// namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::get('/', 'IndexController@index')->name('user.index');
Route::get('/cart', 'ShoppingCartController@index')->name('cart');
Route::get('/{category_name}', 'CategoryController@index')->name('category');

Route::prefix('user')->group(function () {
    Route::get('/login-register', 'UserController@index')->name('user.lr');
    Route::post('/login', 'UserController@Login')->name('user.login');
    Route::post('/signin', 'UserController@Signin')->name('user.signin');
    Route::post('/logout', 'UserController@logout')->name('user.logout');
    Route::get('/activation/{key}', 'UserController@activation')->name('user.activation');
});
