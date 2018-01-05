<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class Categories extends Controller
{
    public function cmsIndex()
    {
      $categories = App\Category::all();
      return view('cms.categories', compact('categories'));
    }

    public function products(App\Category $category)
    {
      $products = $category->products()->get()->map(function ($prod) {
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
      return view('cms.category_products', compact('category', 'categories',
        'brands', 'priceCategories', 'ageRanges', 'products'));
    }
}
