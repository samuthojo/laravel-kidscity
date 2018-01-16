<?php

namespace App\Http\Controllers;

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
      return $this->shop($products);
    }

    private function shop($products)
    {
      $page = "shop";
      $categories = Utils\Utils::getAllCategories();
      // $products = Utils\Utils::getAllProducts();
      $brands = App\Brand::all();
      $selectedCategory = -1;
      $selectedSubCategory = -1;
      $selectedBrand = -1;
      $sub_categories = null;

      $selectedCategoryName = "";
      $selectedSubCategoryName = "";
      $selectedBrandName = "";

      return view('shop.index', compact('selectedCategory', 'selectedCategoryName',
          'selectedSubCategory', 'selectedSubCategoryName', 'selectedBrand',
          'selectedBrandName', 'categories', 'sub_categories',
          'brands', 'products', 'page'));
    }
}
