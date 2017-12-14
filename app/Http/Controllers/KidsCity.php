<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Utils;
class KidsCity extends Controller
{
    public function index()
    {
      $page = 'home';
      $boysProducts = Utils\Utils::getBoysProducts();
      $girlsProducts = Utils\Utils::getGirlsProducts();
      return view('index', compact('page', 'boysProducts', 'girlsProducts'));
    }

    public function shop($id = 1)
    {
      $page = "shop";
      $selectedCategory = App\Category::find($id);
      $categories = Utils\Utils::getAllCategories();
      $products = Utils\Utils::getAllProducts();
      return view('shop', compact('page', 'selectedCategory', 'categories',
                                  'products'));
    }

    public function register()
    {

    }

}
