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

Route::get('/products/{cat}/{p_id}.html', 'ProductController@view')->name('showProduct');

Route::get('/products/{cat}/', 'CategoryController@view')->name('showCategory');

Route::get('/cart.html', 'CheckoutController@cart')->name('checkoutCart');

Route::post('/checkout-add', 'CheckoutController@addToCart')->name('checkoutAdd');
