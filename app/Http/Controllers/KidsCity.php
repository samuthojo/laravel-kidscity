<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\ProductAgeRange;
use Illuminate\Http\Request;
use App;
use App\Utils;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class KidsCity extends Controller
{
    public function index()
    {

        $agent = new Agent();
        if($agent->isPhone())
            return redirect('/mob/');

        $page = "home";
        $boysProducts = Utils\Utils::getBoysProducts();
        $girlsProducts = Utils\Utils::getGirlsProducts();
        $brands = DB::table('brands')
            ->leftJoin('product_brands', 'brands.id', '=', 'product_brands.brand_id')
            ->leftJoin('products', 'products.id', '=', 'product_brands.product_id')
            ->select(DB::raw('brands.*, count(products.id) as product_count'))
            ->groupBy('brands.id')
            ->orderBy('product_count', 'desc')
            ->get();

        return view('index', compact('boysProducts', 'girlsProducts', 'brands', 'page'));
    }

    public function profile()
    {
        $page = "profile";
        return view('profile.index', compact('page'));
    }

    public function shop($filter = "category", $id = -1)
    {
        $page = "shop";
        $categories = Utils\Utils::getAllCategories();
        $products = Utils\Utils::getAllProducts();
        $brands = Brand::all();
        $age_ranges = ProductAgeRange::all();
        $selectedCategory = -1;
        $selectedSubCategory = -1;
        $selectedBrand = -1;
        $sub_categories = null;

        $searchKey = "";

        $pageTitle = "All Products";

        if($id != -1){
            if ($filter == "brand") {
                $brand = Brand::find($id);
                $selectedBrand = $id;
                $selectedBrandName = $brand->name;
                $products = $brand->products()->orderBy('created_at', 'asc')->get();

                $pageTitle = $selectedBrandName;
            }
            else if ($filter == "category") {
                $category = App\Category::find($id)->first();
                $selectedCategoryName = $category->name;
                $selectedCategory = $id;
                $products = $category->products()->orderBy('created_at', 'asc')->get();;

                $pageTitle = $selectedCategoryName;
            }
        }else{
            if(isset($_GET['category'])){
                $id = $_GET['category'];
                $category = App\Category::find($id);

                $selectedCategoryName = $category->name;
                $selectedCategory = $id;
                $products = $category->products()->orderBy('created_at', 'asc')->get();
                $sub_categories = $category->subCategories()->get();

                if(isset($_GET['sub_category'])){
                    $subid = $_GET['sub_category'];
                    $sub_category = App\SubCategory::find($subid);
                    $selectedSubCategory = $subid;

                    $products = $sub_category->products()->orderBy('created_at', 'asc')->get();
                }

                $pageTitle = $selectedCategoryName;
            }
        }

        return view('shop.index', compact('pageTitle', 'selectedCategory',
            'selectedSubCategory', 'selectedBrand', 'categories', 'sub_categories',
            'brands', 'products', 'page', 'age_ranges', 'searchKey'));
    }

    public function new_shop($filter = "category", $id = -1)
    {
        $products = \App\Product::with('categories')->limit(2)->get();
        return $products;
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
