<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;

class SubCategories extends Controller
{
  public function cmsIndex()
  {
    $subCategories = $this->getMappedSubCategories();

    $categories = App\Category::all();

    return view('cms.sub_categories', compact('subCategories', 'categories'));
  }

  private function getMappedSubCategories()
  {
    return App\SubCategory::latest('updated_at')
                          ->get()
                          ->map( function($subCat) {
                            $subCategory = $subCat;
                            $subCategory->category =
                              $subCat->category()->first()->name;
                            return $subCategory;
                          });
  }

  public function products(App\SubCategory $subCategory)
  {
    $products = $subCategory->products()->get()->map(function ($prod) {
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
    return view('cms.sub_category_products', compact('subCategory', 'subCategories',
      'categories', 'brands', 'priceCategories', 'ageRanges', 'products'));
  }

  public function store(Requests\CreateSubCategory $request)
  {
    $subCategory = App\SubCategory::create($request->all());
    $subCategories = $this->getMappedSubCategories();
    return view('cms.tables.sub_categories_table', compact('subCategories'));
  }

  public function update(Requests\UpdateSubCategory $request, $id)
  {
    App\SubCategory::where(compact('id'))->update($request->all());
    $subCategories = $this->getMappedSubCategories();
    return view('cms.tables.sub_categories_table', compact('subCategories'));
  }

  public function destroy(App\SubCategory $subCategory)
  {
    $subCategory->delete();
    $subCategories = $this->getMappedSubCategories();
    return view('cms.tables.sub_categories_table', compact('subCategories'));
  }

}
