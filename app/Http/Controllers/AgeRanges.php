<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class AgeRanges extends Controller
{
    public function cmsIndex()
    {
      $ageRanges = App\ProductAgeRange::all();
      return view('cms.age_ranges', compact('ageRanges'));
    }

    public function products(App\ProductAgeRange $ageRange)
    {
      $products = $ageRange->products()->get()->map(function ($prod) {
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

      return view('cms.age_range_products', compact('ageRange',
      'categories', 'brands', 'priceCategories', 'ageRanges', 'products'));
    }
}
