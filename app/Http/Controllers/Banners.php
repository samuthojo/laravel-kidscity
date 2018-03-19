<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class Banners extends Controller
{
    private $images = 'images';

    private $redirectTo = '/banners';

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

    public function updateAdvertLink(Request $request, $id)
    {
      $this->validate($request, $this->linkRules());
      App\Advert::where(compact('id'))->update($request->only('link'));
    }

    public function updateMainLink(Request $request, App\MainBanner $main)
    {
      $this->validate($request, $this->linkRules());
      $main->update($request->only('link'));
    }

    public function updateFeaturedLink(Request $request, App\FeaturedBanner $featured)
    {
      $this->validate($request, $this->linkRules());
      $featured->update($request->only('link'));
    }

    public function updateCategoryLink(Request $request, App\CategoryBanner $category)
    {
      $this->validate($request, $this->linkRules());
      $category->update($request->only('link'));
    }

    private function linkRules()
    {
      return [
        'link' => 'nullable|url',
      ];
    }
}
