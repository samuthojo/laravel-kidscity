<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use App\Utils;

class Brands extends Controller
{
    private $brandsImages = '/uploads/brands/';

    public function cmsIndex()
    {
      $brands = App\Brand::all();
      return view('cms.brands', compact('brands'));
    }

    public function brand(App\Brand $brand)
    {
      return $brand;
    }

    public function products(App\Brand $brand)
    {
      $products =  $brand->products()->get()->map(function ($prod) {
        $product = $prod;
        $product->category_name = $prod->category()->first()->name;
        $product->sub_category_name = $prod->subCategory()->first()->name;
        $product->age_range = $prod->productAgeRange()->first()->range;
        $product->price_category = $prod->priceCategory()->first()->range;
        $product->brand_name = $prod->brand()->first()->name;

        return $product;
      });

      $categories = App\Category::all();
      $brands = App\Brand::all();
      $priceCategories = App\PriceCategory::all();
      $ageRanges = App\ProductAgeRange::all();
      return view('cms.brand_products', compact('brand', 'categories',
        'brands', 'priceCategories', 'ageRanges', 'products'));
    }

    public function store(Requests\CreateBrand $request)
    {
      if($request->hasFile('image_url')) {
        $brand = $this->saveBrandWithImage($request);
      }
      else {
        $brand = $this->saveBrand($request);
      }
      $brands = App\Brand::all();
      return view('cms.brands', compact('brands'));
    }

    public function update(Requests\UpdateBrand $request, $id)
    {
      return $brand = App\Brand::updateOrCreate(compact('id'), $request->all());
    }

    public function destroy(App\Brand $brand) {
      $brand->delete(); //Softly deleted
      $brands = App\Brand::all();
      return view('cms.brands', compact('brands'));
    }

    private function saveBrandWithImage($request)
    {
      $imageName = Utils\Utils::saveImage($request->file('image_url'),
                                                          $this->brandsImages);
      $newBrand = array_add($request->except('image_url'), 'image_url', $imageName);
      return App\Brand::create($newBrand);
    }

    private function saveBrand($request)
    {
      return App\Brand::create($request->all());
    }

}
