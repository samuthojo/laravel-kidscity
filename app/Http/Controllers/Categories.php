<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;

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
        $product->sub_category_name = $prod->subCategory()->first()->name;
        $product->age_range = $prod->productAgeRange()->first()->range;
        $product->price_category = $prod->priceCategory()->first()->range;
        $product->brand_name = $prod->brand()->first()->name;

        return $product;
      });

      $categories = App\Category::all();
      $subCategories = App\SubCategory::all();
      $brands = App\Brand::all();
      $priceCategories = App\PriceCategory::all();
      $ageRanges = App\ProductAgeRange::all();
      return view('cms.category_products', compact('category', 'categories',
        'subCategories', 'brands', 'priceCategories', 'ageRanges', 'products'));
    }

    public function store(Requests\CreateCategory $request)
    {
      $category = App\Category::create($request->all());
      $categories = App\Category::latest('updated_at')->get();
      return view('cms.tables.categories_table', compact('categories'));
    }

    public function update(Requests\UpdateCategory $request, $id)
    {
      App\Category::where('id', $id)->update($request->all());
      $categories = App\Category::latest('updated_at')->get();
      return view('cms.tables.categories_table', compact('categories'));
    }

    public function destroy(App\Category $category)
    {
      $category->delete();
      $categories = App\Category::latest('updated_at')->get();
      return view('cms.tables.categories_table', compact('categories'));
    }
}
