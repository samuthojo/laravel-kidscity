<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class KidsCity extends Controller
{
    public function index()
    {
      $page = 'home';
      $boysProducts = $this->maleProducts();
      $girlsProducts = $this->femaleProducts();
      return view('index', compact('page', 'boysProducts', 'girlsProducts'));
    }

    public function shop($category = 0)
    {
      $page = "shop";
      $categories = ["All", "Kids Wear", "School Uniforms", "Accessories"];
      $products = $this->products();
      return view('shop', compact('page', 'category', 'categories',
                                  'products'));
    }

    public function products()
    {
      return App\Product::all();
    }

    public function maleProducts()
    {
      return App\Product::where('gender', false)->get();
    }

    public function femaleProducts()
    {
      return App\Product::where('gender', true)->get();
    }
}
