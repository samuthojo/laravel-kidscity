<?php

namespace App\Utils;

use App;

class Utils
{

    public static function getBoysProducts()
    {
      return App\Product::with('pictures')->where('gender', false)->get();
    }

    public static function getGirlsProducts()
    {
      return App\Product::with('pictures')->where('gender', true)->get();
    }

    public static function getAllCategories()
    {
      return App\Category::all();
    }

    public static function getAllProducts()
    {
      return App\Product::all();
    }

    public static function saveImage($image, $destination)
    {
      $imageName = uniqid() . "." . $image->getClientOriginalExtension();
      $image->move($destination, $imageName);
      return $imageName;
    }
}
