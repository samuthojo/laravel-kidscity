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
    return view('test');

    $id = 1;
    $rowId = Cart::search(function ($cartItem) use ($id) {
        return $cartItem->model->id == $id;
    })->first()->rowId;

    return Cart::update($rowId, 3);
});


Route::prefix('/mob')->group(function() {
    Route::get('/', 'KidsCityMob@index');
    Route::get('/shop/{filterer?}/{category?}', 'KidsCityMob@shop');
    Route::get('/products/{product}', 'KidsCityMob@product');
    Route::get('/cart/', 'KidsCityMob@cart');
    Route::get('/checkout/', 'KidsCityMob@checkout');
    Route::get('/profile/', 'KidsCityMob@profile');
});

Route::get('/search', 'Search@search')->name('search');

Auth::routes();


Route::get('/admin/login', 'Auth\LoginController@showCmsLoginForm')->name('cms_login');
Route::post('/admin/login', 'Auth\LoginController@cmsLogin')->name('cms_authenticate');
Route::post('/admin/logout', 'Auth\LoginController@cmsLogout')->name('cms_logout');

Route::middleware('admin')->prefix('/admin')->group(function() {
  Route::get('/', 'Brands@cmsIndex')->name('main');
  Route::get('/brands', 'Brands@cmsIndex')->name('brands.index');
  Route::get('/brands/{brand}/brand', 'Brands@brand')->name('brands.brand');
  Route::get('/brands/{brand}/products', 'Brands@products')->name('brands.products');
  Route::post('/brands', 'Brands@store')->name('brands.store');
  Route::post('/brands/{brand}/store_product', 'Brands@storeProduct')->name('brands.store_product');
  Route::post('/brands/{brand}/update_product/{product}', 'Brands@updateProduct')->name('brands.update_product');
  Route::delete('/brands/{brand}/delete_product/{product}', 'Brands@deleteProduct')->name('brands.delete_product');
  Route::post('/brands/{brand}', 'Brands@update')->name('brands.update');
  Route::delete('/brands/{brand}', 'Brands@destroy')->name('brands.destroy');

  Route::get('/age_ranges', 'AgeRanges@cmsIndex')->name('age_ranges.index');
  Route::get('/age_ranges/{ageRange}/products', 'AgeRanges@products')->name('age_ranges.products');
  Route::post('/age_ranges', 'AgeRanges@store')->name('age_ranges.store');
  Route::post('/age_ranges/{ageRange}/store_product', 'AgeRanges@storeProduct')->name('age_ranges.store_product');
  Route::post('/age_ranges/{ageRange}/update_product/{product}', 'AgeRanges@updateProduct')->name('age_ranges.update_product');
  Route::delete('/age_ranges/{ageRange}/delete_product/{product}', 'AgeRanges@deleteProduct')->name('age_ranges.delete_product');
  Route::post('/age_ranges/{ageRange}', 'AgeRanges@update')->name('age_ranges.update');
  Route::delete('/age_ranges/{ageRange}', 'AgeRanges@destroy')->name('age_ranges.destroy');


  Route::get('/customers', 'Users@cmsIndex')->name('users.index');

  Route::get('/categories', 'Categories@cmsIndex')->name('categories.index');
  Route::get('/categories/{category}/products', 'Categories@products')->name('categories.products');
  Route::get('/categories/{category}/sub_categories', 'Categories@subCategories')->name('categories.sub_categories');
  Route::post('/categories', 'Categories@store')->name('categories.store');
  Route::post('/categories/{category}/store_product', 'Categories@storeProduct')->name('categories.store_product');
  Route::post('/categories/{category}/update_product/{product}', 'Categories@updateProduct')->name('categories.update_product');
  Route::delete('/categories/{category}/delete_product/{product}', 'Categories@deleteProduct')->name('categories.delete_product');
  Route::post('/categories/{category}', 'Categories@update')->name('categories.update');
  Route::delete('/categories/{category}', 'Categories@destroy')->name('categories.destroy');

  Route::get('/sub_categories', 'SubCategories@cmsIndex')->name('sub_categories.index');
  Route::get('/sub_categories/{subCategory}/products', 'SubCategories@products')->name('sub_categories.products');
  Route::post('/sub_categories', 'SubCategories@store')->name('sub_categories.store');
  Route::post('/sub_categories/{subCategory}/store_product', 'SubCategories@storeProduct')->name('sub_categories.store_product');
  Route::post('/sub_categories/{subCategory}/update_product/{product}', 'SubCategories@updateProduct')->name('sub_categories.update_product');
  Route::delete('/sub_categories/{subCategory}/delete_product/{product}', 'SubCategories@deleteProduct')->name('sub_categories.delete_product');
  Route::post('/sub_categories/{subCategory}', 'SubCategories@update')->name('sub_categories.update');
  Route::delete('/sub_categories/{subCategory}', 'SubCategories@destroy')->name('sub_categories.destroy');

  Route::get('/price_categories', 'PriceCategories@cmsIndex')->name('price_categories.index');
  Route::get('/price_categories/{priceCategory}/products', 'PriceCategories@products')->name('price_categories.products');
  Route::post('/price_categories', 'PriceCategories@store')->name('price_categories.store');
  Route::post('/price_categories/{priceCategory}/store_product', 'PriceCategories@storeProduct')->name('price_categories.store_product');
  Route::post('/price_categories/{priceCategory}/update_product/{product}', 'PriceCategories@updateProduct')->name('price_categories.update_product');
  Route::delete('/price_categories/{priceCategory}/delete_product/{product}', 'PriceCategories@deleteProduct')->name('price_categories.delete_product');
  Route::post('/price_categories/{priceCategory}', 'PriceCategories@update')->name('price_categories.update');
  Route::delete('/price_categories/{priceCategory}', 'PriceCategories@destroy')->name('price_categories.destroy');

  Route::get('/products', 'Products@cmsIndex')->name('products.index');
  Route::get('/products/create', 'Products@create')->name('products.create');
  Route::get('/products/{product}/product', 'Products@cmsProduct')->name('products.product');
  Route::post('/products', 'Products@store')->name('products.store');
  Route::post('/products/{product}', 'Products@update')->name('products.update');
  Route::delete('/products/{product}', 'Products@destroy')->name('products.destroy');

  Route::get('/orders', 'Orders@cmsIndex')->name('orders.index');
  Route::get('/processed', 'Orders@processed')->name('orders.processed');
  Route::delete('/processed/{order}', 'Orders@deleteProcessed')->name('orders.delete_processed');
  Route::get('/processed/{order}/items', 'Orders@items')->name('processed.items');
  Route::get('/orders/{order}/items', 'Orders@items')->name('orders.items');
  Route::post('/orders/{order}', 'Orders@process')->name('orders.process');
  Route::delete('/orders/{order}', 'Orders@destroy')->name('orders.destroy');

  Route::get('/locations', 'DeliveryLocations@cmsIndex')->name('locations.index');
  Route::post('/locations', 'DeliveryLocations@store')->name('locations.store');
  Route::post('/locations/{location}', 'DeliveryLocations@update')->name('locations.update');
  Route::delete('/locations/{location}', 'DeliveryLocations@destroy')->name('locations.destroy');

  Route::get('/banners', 'Banners@cmsIndex')->name('banners.index');
  Route::post('/advert/{advert}', 'Banners@updateAdvert')->name('banners.updateAdvert');
  Route::post('/main_banner/{main}', 'Banners@updateMainBanner')->name('banners.updateMainBanner');
  Route::post('/featured_banner/{featured}', 'Banners@updateFeaturedBanner')->name('banners.updateFeaturedBanner');
  Route::post('/category_banner/{category}', 'Banners@updateCategoryBanner')->name('banners.updateCategoryBanner');

  Route::view('/change_password', 'cms.change_password')->name('change_password');
  Route::post('/change_password', 'Auth\AdminResetPasswordController@reset')->name("reset_admin_password");
});
