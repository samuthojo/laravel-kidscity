<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Utils;

class Products extends Controller
{
    public function product(App\Product $product)
    {
      $page = 'product_detail';
      return view('product_detail', compact('page', 'product'));
    }

    public function cart()
    {
      $page = "cart";
      $boysProducts = Utils\Utils::getBoysProducts();
      return view('cart.index', compact('page', 'boysProducts'));
    }

    public function cmsIndex()
    {
      $products = App\Product::all()->map(function ($prod) {
        $product = $prod;
        $product->category_name = $prod->category()->first()->name;
        $product->age_range = $prod->productAgeRange()->first()->range;
        $product->price_category = $prod->priceCategory()->first()->range;
        $product->brand_name = $prod->brand()->first()->name;

        return $product;
      });

      $categories = App\Category::all();
      $brands = App\Brand::all();
      $priceCategories = App\PriceCategory::all();
      $ageRanges = App\ProductAgeRange::all();
      return view('cms.products', compact('categories',
        'brands', 'priceCategories', 'ageRanges', 'products'));
    }
}
