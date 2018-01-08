<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PriceCategories extends Controller
{
    public function cmsIndex()
    {
      $priceCategories = App\PriceCategory::all();
      return view('cms.price_categories', compact('priceCategories'));
    }

    public function products(App\PriceCategory $priceCategory)
    {
      $products = $priceCategory->products()->get()->map(function ($prod) {
        $product = $prod;
        $product->category_name = $prod->category()->first()->name;
        $product->sub_category_name = $prod->subCategory()->first()->name;
        $product->age_range = $prod->productAgeRange()->first()->range;
        $product->price_category = $prod->priceCategory()->first()->range;
        $product->brand_name = $prod->brand()->first()->name;

        return $product;
      });

      $categories = App\Category::all();
      $brands = App\Brand::all();
      $priceCategories = App\PriceCategory::all();
      $ageRanges = App\ProductAgeRange::all();

      return view('cms.price_category_products', compact('priceCategory',
      'categories', 'brands', 'priceCategories', 'ageRanges', 'products'));
    }
}
