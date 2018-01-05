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

    public function subCategories()
    {
      $subCategories =
      App\SubCategory::all()
                    ->map( function($subCat) {
                      $subCategory = $subCat;
                      $subCategory->category = $subCat->category()->first()->name;
                      return $subCategory;
                    });
      return view('cms.sub_categories', compact('subCategories'));
    }
}
