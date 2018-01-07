<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use Illuminate\Http\Request;
use App;
use App\Utils;
use Illuminate\Support\Facades\DB;

class KidsCity extends Controller
{
    public function index()
    {
        $page = "home";
        $boysProducts = Utils\Utils::getBoysProducts();
        $girlsProducts = Utils\Utils::getGirlsProducts();
        $brands = DB::table('brands')
            ->leftJoin('products', 'brands.id', '=', 'products.brand_id')
            ->select(DB::raw('brands.*, count(products.id) as product_count'))
            ->groupBy('brands.id')
            ->orderBy('product_count', 'desc')
            ->get();

        return view('index', compact('boysProducts', 'girlsProducts', 'brands', 'page'));
    }

    public function shop($filter = "category", $id = -1)
    {
        $page = "shop";
        $categories = Utils\Utils::getAllCategories();
        $products = Utils\Utils::getAllProducts();
        $brands = Brand::all();
        $selectedCategory = -1;
        $selectedBrand = -1;

        $selectedCategoryName = "";
        $selectedBrandName = "";

        if($id != -1){
            if ($filter == "brand") {
                $selectedBrand = $id;
                $selectedBrandName = Brand::find($id)->name;
                $products = App\Product::where("brand_id", $id)->get();
            }
            else if ($filter == "category") {
                $selectedCategoryName = App\Category::find($id)->name;
                $selectedCategory = $id;
                $products = App\Product::where("category_id", $id)->get();
            }
        }

        return view('shop.index', compact('selectedCategory', 'selectedCategoryName', 'selectedBrand',
            'selectedBrandName', 'categories', 'brands', 'products', 'page'));
    }

    public function brands()
    {
        $page = "brands";
        $brands = DB::table('brands')
            ->leftJoin('products', 'brands.id', '=', 'products.brand_id')
            ->select(DB::raw('brands.*, count(products.id) as product_count'))
            ->groupBy('brands.id')
            ->orderBy('product_count', 'desc')
            ->get();
        return view('brands.index', compact('brands', 'page'));
    }

    public function register()
    {

    }
}
