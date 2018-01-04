<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Product;

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
        $dummy_items = [
            ["item_id" => 1, "quantity" => 1],
            ["item_id" => 2, "quantity" => 3]
        ];
//        session(['cart_items' => []]);
        $cart_items = session('cart_items', $dummy_items);
//        $cart_items = session('cart_items', []);
        $parsed_items = [];
        $cart_item_ids = [];

        foreach ($cart_items as $item){
            $cart_item_ids[] = $item["item_id"];
            $parsed_items[] = [
                "item" => Product::find($item["item_id"]),
                "quantity" => $item["quantity"]
            ];
        }

        view()->share('cart_items', $parsed_items);
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
