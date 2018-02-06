<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class Banners extends Controller
{
    private $images = 'images';

    public function cmsIndex()
    {
      $adverts = App\Advert::all();
      $mainBanners = App\MainBanner::all();
      $featuredBanners = App\FeaturedBanner::all();
      $categoryBanners = App\CategoryBanner::all();
      return view('cms.banners.banners', compact('adverts', 'mainBanners',
                                                 'featuredBanners', 'categoryBanners'));
    }

    public function updateAdvert(Request $request, $id)
    {
      if($request->hasFile('image_url')) {
        $image_url =
        \App\Utils\Utils::saveImage($request->file('image_url'), $this->images);
        App\Advert::where(compact('id'))->update(compact('image_url'));
      }
    }

    public function updateMainBanner(Request $request, $id)
    {
      if($request->hasFile('image_url')) {
        $image_url =
        \App\Utils\Utils::saveImage($request->file('image_url'), $this->images);
        App\MainBanner::where(compact('id'))->update(compact('image_url'));
      }
    }

    public function updateFeaturedBanner(Request $request, $id)
    {
      if($request->hasFile('image_url')) {
        $image_url =
        \App\Utils\Utils::saveImage($request->file('image_url'), $this->images);
        App\FeaturedBanner::where(compact('id'))->update(compact('image_url'));
      }
    }

    public function updateCategoryBanner(Request $request, $id)
    {
      if($request->hasFile('image_url')) {
        $image_url =
        \App\Utils\Utils::saveImage($request->file('image_url'), $this->images);
        App\CategoryBanner::where(compact('id'))->update(compact('image_url'));
      }
    }
}
