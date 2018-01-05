<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class AgeRanges extends Controller
{
    public function cmsIndex()
    {
      $ageRanges = App\ProductAgeRange::all();
      return view('cms.age_ranges', compact('ageRanges'));
    }
}
