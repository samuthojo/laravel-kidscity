<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\DeliveryLocation;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Utils;

class KidsCityMob extends Controller
{
    public function index()
    {
        $page = "home";
        $boysProducts = Utils\Utils::getBoysProducts();
        $girlsProducts = Utils\Utils::getGirlsProducts();
        $brands = DB::table('brands')
            ->leftJoin('product_brands', 'brands.id', '=', 'product_brands.brand_id')
            ->leftJoin('products', 'products.id', '=', 'product_brands.product_id')
            ->select(DB::raw('brands.*, count(products.id) as product_count'))
            ->groupBy('brands.id')
            ->orderBy('product_count', 'desc')
            ->limit(4)
            ->get();

        $popular = Product::all()->random()->limit(4)->get();
        $clothes = Product::all()->random()->limit(4)->get();
        $baby_products = [];
        $school_items = [];

        return view('mobile.index', compact('page', 'brands', 'popular', 'clothes', 'baby_products', 'school_items'));
    }

    public function shop($filter = "category", $id = -1)
    {
        $selectedCategory = -1;
        $page = "shop";
        $sub_categories = SubCategory::all();
        $products = Product::orderBy('created_at', 'asc')
            ->get();
        $categories = Category::with("subCategories")->get();


        if(isset($_GET['category'])){
            $id = $_GET['category'];
            $category = Category::find($id);

            $selectedCategory = $id;
            $products = $category->products()->orderBy('created_at', 'asc')->get();
            $sub_categories = $category->subCategories()->get();

            if(isset($_GET['sub_category'])){
                $subid = $_GET['sub_category'];
                $sub_category = SubCategory::find($subid);

                $products = $sub_category->products()->orderBy('created_at', 'asc')->get();
            }
        }

        return view('mobile.shop', compact('page', 'categories', 'selectedCategory', 'sub_categories', 'products'));
    }

    public function product(Product $product)
    {
        $page = "shop";
        return view('mobile.product', compact('page', 'product'));
    }

    public function cart()
    {
        $page = "cart";
        return view('mobile.cart', compact('page'));
    }

    public function checkout()
    {
        $page = "checkout";
        $locations = DeliveryLocation::all();
        return view('mobile.checkout', compact('page', 'locations'));
    }

    public function profile()
    {
        $page = "profile";
        return view('mobile.profile', compact('page'));
    }
}
