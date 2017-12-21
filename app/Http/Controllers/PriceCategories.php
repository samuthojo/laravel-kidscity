
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PriceCategories extends Controller
{
    public function index()
    {
      $priceCategories = App\PriceCategory::all();
      return view('cms.price_categories', compact('priceCategories'));
    }
}
