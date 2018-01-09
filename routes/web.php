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

use Gloudemans\Shoppingcart\Facades\Cart;

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'KidsCity@profile')->name('profile');

Route::get('/', 'KidsCity@index');
Route::get('/brands', 'KidsCity@brands');
Route::get('/shop/{filterer?}/{category?}', 'KidsCity@shop');
Route::get('/products/{product}', 'Products@product');
Route::get('/register', 'KidsCity@register');

Route::get('/cart', 'CartController@index');
Route::post('/addToCart', 'CartController@add')->name('addToCart');
Route::post('/removeFromCart', 'CartController@remove')->name('removeFromCart');
Route::post('/setQty', 'CartController@set_qty')->name('setQty');
Route::post('/checkout', 'CartController@checkout')->name('checkout');

Route::get('/cartItems', function(){
    $id = 1;
    return Cart::search(function ($cartItem) use ($id) {
        return $cartItem->model->id == $id;
    })->first()->rowId;
});


Route::prefix('/mob')->group(function() {
    Route::get('/', 'KidsCityMob@index');
    Route::get('/shop/{filterer?}/{category?}', 'KidsCityMob@shop');
    Route::get('/cart/', 'KidsCityMob@cart');
    Route::get('/profile/', 'KidsCityMob@profile');
});

Auth::routes();


Route::get('/admin/login', 'Auth\LoginController@showCmsLoginForm')->name('cms_login');
Route::post('/admin/login', 'Auth\LoginController@cmsLogin')->name('cms_authenticate');
Route::post('/admin/logout', 'Auth\LoginController@cmsLogout')->name('cms_logout');


Route::prefix('/admin')->group(function() {
  Route::get('/', 'Brands@cmsIndex')->name('main');
  Route::get('/brands', 'Brands@cmsIndex')->name('brands.index');
  Route::post('/brands', 'Brands@store')->name('brands.store');
  Route::post('/brands/{brand}', 'Brands@update')->name('brands.update');
  Route::delete('/brands/{brand}', 'Brands@destroy')->name('brands.destroy');

  Route::get('/categories', 'Categories@cmsIndex')->name('categories.index');
  Route::get('/price_categories', 'PriceCategories@cmsIndex')->name('price_categories.index');
  Route::get('/products', 'Products@cmsIndex')->name('products.index');
  Route::get('/orders', 'Orders@cmsIndex')->name('orders.index');
  Route::get('/locations', 'DeliveryLocations@cmsIndex')->name('locations.index');
  Route::view('/change_password', 'change_password')->name('change_password');
});
