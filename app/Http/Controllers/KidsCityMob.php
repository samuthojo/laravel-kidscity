<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\DeliveryLocation;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KidsCityMob extends Controller
{
    public function index()
    {
        $page = "home";
        $brands = DB::table('brands')
            ->leftJoin('products', 'brands.id', '=', 'products.brand_id')
            ->select(DB::raw('brands.*, count(products.id) as product_count'))
            ->groupBy('brands.id')
            ->orderBy('product_count', 'desc')
            ->limit(4)
            ->get();
        $popular = Product::where("id", ">", 6)->limit(4)->get();
        $clothes = Product::where("category_id", 1)->limit(4)->get();
        $baby_products = Product::where("category_id", 2)->limit(4)->get();
        $school_items = Product::where("category_id", 5)->limit(4)->get();

        return view('mobile.index', compact('page', 'brands', 'popular', 'clothes', 'baby_products', 'school_items'));
    }

    public function shop($filter = "category", $id = -1)
    {
        $selectedCategory = -1;
        $page = "shop";
        $categories = Category::with("subCategories")->get();

        if(isset($_GET['category'])){
            $id = $_GET['category'];
            $selectedCategory = $id;
            $sub_categories = SubCategory::where("category_id", $id)->get();
            $products = Product::where("category_id", $id)->orderBy('created_at', 'asc')
                ->get();

            return view('mobile.shop', compact('page', 'categories', 'selectedCategory', 'sub_categories', 'products'));
        }

        $sub_categories = SubCategory::all();
        $products = Product::orderBy('created_at', 'asc')
            ->get();
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
