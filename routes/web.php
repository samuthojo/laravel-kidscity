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

Route::get('/', 'KidsCity@index');
Route::get('/brands', 'KidsCity@brands');
//Route::get('/shop/{category?}', 'KidsCity@shop');
Route::get('/shop/{filterer?}/{category?}', 'KidsCity@shop');
Route::get('/products/{product}', 'Products@product');
Route::get('/cart', 'Products@cart');
Route::get('/register', 'KidsCity@register');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
