<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class Banners extends Controller
{
    public function cmsIndex()
    {
      return view('cms.banners.banners');
    }

    public function updateAdvert(Request $request, $advert)
    {
      App\Advert::where('id', $advert)->update($request->all());
    }

    public function updateMainBanner(Request $request, $main)
    {
      App\MainBanner::where('id', $main)->update($request->all());
    }

    public function updateFeaturedBanner(Request $request, $featured)
    {
      App\FeaturedBanner::where('id', $featured)->update($request->all());
    }

    public function updateCategoryBanner(Request $request, $category)
    {
      App\CategoryBanner::where('id', $category)->update($request->all());
    }
}
