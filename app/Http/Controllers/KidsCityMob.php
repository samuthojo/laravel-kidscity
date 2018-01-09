<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class KidsCityMob extends Controller
{
    public function index()
    {
        $page = "home";
        return view('mobile.index', compact('page'));
    }

    public function shop($filter = "category", $id = -1)
    {
        $page = "shop";
        $categories = Category::with("subCategories")->get();
        return view('mobile.shop', compact('page', 'categories'));
    }

    public function profile()
    {
        $page = "profile";
        return view('mobile.profile', compact('page'));
    }

    public function cart()
    {
        $page = "cart";
        return view('mobile.cart', compact('page'));
    }
}
