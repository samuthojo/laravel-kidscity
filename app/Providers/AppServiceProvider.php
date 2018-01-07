<?php

namespace App\Providers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $cart_items = Cart::content();
        $cart_item_ids = [];

        if($cart_items && $cart_items->count() > 0) {
            foreach ($cart_items as $item){
                $cart_item_ids[] = $item["id"];
            }
        }

        view()->share('cart_items', $cart_items);
        view()->share('cart_item_ids', $cart_item_ids);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
