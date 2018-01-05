<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class DeliveryLocations extends Controller
{
  public function cmsIndex()
  {
    $locations = App\DeliveryLocation::all();
    return view('cms.locations', compact('locations'));
  }
}
