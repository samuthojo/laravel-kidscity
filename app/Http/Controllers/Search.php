<?php

namespace App\Http\Controllers;

use App\ProductAgeRange;
use Illuminate\Http\Request;
use App;
use App\Utils;

class Search extends Controller
{
    public function search(Request $request)
    {
      $searchKey = $request->search;
      $products = App\Product::search($searchKey)->get();
      if($request->expectsJson()) {
        //Is ajax request
        return $products; //Laravel automatically converts to Json
      }
      return $this->shop($products, $searchKey);
    }

    private function shop($products, $searchKey)
    {
      $page = "shop";
      $age_ranges = ProductAgeRange::all();
      $categories = Utils\Utils::getAllCategories();
      // $products = Utils\Utils::getAllProducts();
      $brands = App\Brand::all();
      $age_ranges = App\ProductAgeRange::all();
      $selectedCategory = -1;
      $selectedSubCategory = -1;
      $selectedBrand = -1;
      $sub_categories = null;

      $selectedCategoryName = $searchKey;
      $selectedSubCategoryName = $searchKey;
      $selectedBrandName = $searchKey;

      $pageTitle = $searchKey;

      return view('shop.index', compact('pageTitle', 'selectedCategory', 'selectedCategoryName',
          'selectedSubCategory', 'selectedSubCategoryName', 'selectedBrand',
          'selectedBrandName', 'categories', 'sub_categories', 'age_ranges',
          'brands', 'products', 'page'));
    }
}
