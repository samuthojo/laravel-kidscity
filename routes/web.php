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

Route::get('/admin/login', 'Auth\LoginController@showCmsLoginForm')->name('cms_login');
Route::post('/admin/login', 'Auth\LoginController@cmsLogin')->name('cms_authenticate');
Route::post('/admin/logout', 'Auth\LoginController@cmsLogout')->name('cms_logout');
Route::get('/admin', 'Brands@index')->name('main');

Route::middleware('auth')->prefix('/admin')->group(function() {
  // Route::get('/', 'Brands@index')->name('main');
  Route::get('/brands', 'Brands@index')->name('brands.index');
  Route::post('/brands', 'Brands@store')->name('brands.store');
  Route::post('/brands/{brand}', 'Brands@update')->name('brands.update');
  Route::delete('/brands/{brand}', 'Brands@destroy')->name('brands.destroy');

  Route::get('/categories', 'Categories@index')->name('categories.index');
  Route::get('/price_categories', 'PriceCategories@index')->name('price_categories.index');
  Route::get('/products', 'Products@index')->name('products.index');
  Route::get('/orders', 'Orders@index')->name('orders.index');
  Route::get('/locations', 'DeliveryLocations@index')->name('locations.index');
  Route::view('/change_password', 'change_password')->name('change_password');
});
