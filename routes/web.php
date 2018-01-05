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

Route::prefix('/admin')->group(function() {
  Route::get('/', 'Brands@cmsIndex')->name('main');
  Route::get('/brands', 'Brands@cmsIndex')->name('brands.index');
  Route::get('/brands/{brand}/brand', 'Brands@brand')->name('brands.brand');
  Route::get('/brands/{brand}/products', 'Brands@products')->name('brands.products');
  Route::post('/brands', 'Brands@store')->name('brands.store');
  Route::post('/brands/{brand}', 'Brands@update')->name('brands.update');
  Route::delete('/brands/{brand}', 'Brands@destroy')->name('brands.destroy');

  Route::get('/age_ranges', 'AgeRanges@cmsIndex')->name('age_ranges.index');

  Route::get('/customers', 'Users@cmsIndex')->name('users.index');

  Route::get('/categories', 'Categories@cmsIndex')->name('categories.index');
  Route::get('/categories/{category}/products', 'Categories@products')->name('categories.products');
  Route::get('/sub_categories', 'SubCategories@cmsIndex')->name('sub_categories.index');
  Route::get('/sub_categories/{subCategory}/products', 'SubCategories@products')->name('sub_categories.products');

  Route::get('/price_categories', 'PriceCategories@cmsIndex')->name('price_categories.index');
  Route::get('/price_categories/{priceCategory}/products', 'PriceCategories@products')->name('price_categories.products');

  Route::get('/products', 'Products@cmsIndex')->name('products.index');
  Route::get('/orders', 'Orders@cmsIndex')->name('orders.index');
  Route::get('/locations', 'DeliveryLocations@cmsIndex')->name('locations.index');
  Route::view('/change_password', 'change_password')->name('change_password');
});
