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

// use Illuminate\Routing\Route;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/admin', 'namespace' => 'admin'], function () {
    Route::redirect('/', '/admin/login');
    Route::match(['get', 'post'], '/login', 'UsersController@Login')->name('admin.login');
    Route::get('/index', 'IndexController@index')->name('admin.index');
});

Route::get('/', 'IndexController@index')->name('index');
Route::get('/category/{category_name}', 'CategoryController@index')->name('category');
Route::get('/product/{product}', 'ProductController@index')->name('product');
Route::post('/search', 'ProductController@search_product')->name('search_product');
Route::get('/search', 'ProductController@search_product')->name('search_product');

Route::prefix('cart')->group(function () {
    Route::get('/', 'CartController@index')->name('cart');
    Route::post('/add_product', 'CartController@add_product')->name('add_product');
    Route::delete('/delete_product/{rowId}', 'CartController@delete_product')->name('delete_product');
    Route::delete('/clear_cart', 'CartController@clear_cart')->name('clear_cart');
    Route::patch('/update/{rowId}', 'CartController@update')->name('cart_update');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/orders', 'OrdersController@index')->name('orders');
    Route::get('/orders/{id}', 'OrdersController@order_detail')->name('order_detail');
});

Route::prefix('users')->group(function () {
    Route::get('/login', 'UsersController@Login_form')->name('users.Login_form');
    Route::post('/login', 'UsersController@Login')->name('users.Login');

    Route::get('/signin', 'UsersController@signin_form')->name('users.signin_form');
    Route::post('/signin', 'UsersController@signin');
    Route::get('/activation/{key}', 'UsersController@activation')->name('users.activation');

    Route::post('/logout', 'UsersController@Logout')->name('users.Logout');
});

Route::get('/payment', 'PaymentController@index')->name('payment');
Route::post('/payment', 'PaymentController@pay')->name('payment.pay');

// Route::get('/test/mail', function () {
//     $user = \App\Models\Users::find(1);
//     return new App\Mail\userSinginMail($user);
// });
