<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Utils;

class Products extends Controller
{
    public function product(App\Product $product)
    {
      $page = 'product_detail';
      return view('product_detail', compact('page', 'product'));
    }

    public function cart()
    {
      $page = "cart";
      $boysProducts = Utils\Utils::getBoysProducts();
      return view('cart.index', compact('page', 'boysProducts'));
    }
}
