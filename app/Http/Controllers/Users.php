<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class Users extends Controller
{
    public function cmsIndex()
    {
      $customers = App\User::where('is_admin', false)->get();
      return view('cms.customers', compact('customers'));
    }
}
