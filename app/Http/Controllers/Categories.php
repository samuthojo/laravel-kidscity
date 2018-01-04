<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class Categories extends Controller
{
    public function cmsIndex()
    {
      $categories = App\Category::all();
      return view('cms.categories', compact('categories'));
    }
}
