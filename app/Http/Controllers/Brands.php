<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use App\Utils;

class Brands extends Controller
{
    private $brandImages = 'images/brands/';

    private $productImages = 'images/products/';

    public function cmsIndex()
    {
      $brands = App\Brand::latest('updated_at')->get();
      return view('cms.brands', compact('brands'));
    }

    public function brand(App\Brand $brand)
    {
      return $brand;
    }

    public function products(App\Brand $brand)
    {
      $products =  $brand->products()
                         ->latest('updated_at')->get()
                         ->map(function ($prod) {
                            $product = $prod;
                            $product->category_name = $prod->category()->first()->name;
                            $product->sub_category_name = $prod->subCategory()->first()->name;
                            $product->age_range = $prod->productAgeRange()->first()->range;
                            $product->price_category = $prod->priceCategory()->first()->range;
                            $product->brand_name = $prod->brand()->first()->name;

                            return $product;
                          });

      $categories = App\Category::all();
      $subCategories = App\SubCategory::all();
      $brands = App\Brand::all();
      $priceCategories = App\PriceCategory::all();
      $ageRanges = App\ProductAgeRange::all();
      return view('cms.brand_products', compact('brand', 'categories',
        'subCategories', 'brands', 'priceCategories', 'ageRanges', 'products'));
    }

    public function store(Requests\CreateBrand $request)
    {
      if($request->hasFile('image_url')) {
        $brand = $this->saveBrandWithImage($request);
      }
      else {
        $brand = $this->saveBrand($request);
      }
      $brands = App\Brand::latest('updated_at')->get();
      return view('cms.tables.brands_table', compact('brands'));
    }

    public function update(Requests\UpdateBrand $request, $id)
    {
      if(!$request->hasFile('image_url')) {
        $brand = App\Brand::updateOrCreate(compact('id'), $request->all());
      }
      else {
        $imageName = Utils\Utils::saveImage($request->file('image_url'),
                                                            $this->brandImages);
        $editedBrand = array_add($request->except('image_url'), 'image_url', $imageName);
        $brand = App\Brand::updateOrCreate(compact('id'), $editedBrand);
      }
      $brands = App\Brand::latest('updated_at')->get();
      return view('cms.tables.brands_table', compact('brands'));
    }

    public function destroy(App\Brand $brand) {
      $brand->delete(); //Softly deleted
      $brands = App\Brand::latest('updated_at')->get();
      return view('cms.tables.brands_table', compact('brands'));
    }

    private function saveBrandWithImage($request)
    {
      $imageName = Utils\Utils::saveImage($request->file('image_url'),
                                                          $this->brandImages);
      $newBrand = array_add($request->except('image_url'), 'image_url', $imageName);
      return App\Brand::create($newBrand);
    }

    private function saveBrand($request)
    {
      return App\Brand::create($request->all());
    }

    public function storeProduct(Requests\CreateBrandProduct $request, $brandId)
    {
      if($request->hasFile('image_url')) {
        $product = $this->saveProductWithImage($request, $brandId);
      }
      else {
        $newProduct = array_add($request->all(), 'brand_id', $brandId);
        $product = App\Product::create($newProduct);
      }
      return $this->productsTable($brandId);
    }

    public function updateProduct(Requests\UpdateBrandProduct $request, $brandId,
                                    $productId)
    {
      if($request->hasFile('image_url')) {
        $this->updateProductWithImage($request, $brandId, $productId);
      }
      else {
        $id = $productId;
        $editedProduct = array_add($request->all(), 'brand_id', $brandId);
        App\Product::where(compact('id'))->update($editedProduct);
      }
      return $this->productsTable($brandId);
    }

    public function deleteProduct($brandId, $productId)
    {
      App\Product::find($productId)->delete();
      return $this->productsTable($brandId);
    }

    private function saveProductWithImage($request, $brandId)
    {
      $imageName = Utils\Utils::saveImage($request->file('image_url'),
                                                          $this->productImages);
      $newProduct = array_add($request->except('image_url'), 'image_url', $imageName);
      $newProduct = array_add($newProduct, 'brand_id', $brandId);
      return App\Product::create($newProduct);
    }

    private function updateProductWithImage($request, $brandId, $productId)
    {
      $imageName = Utils\Utils::saveImage($request->file('image_url'),
                                                          $this->productImages);
      $editedProduct = array_add($request->except('image_url'), 'image_url', $imageName);
      $editedProduct = array_add($editedProduct, 'brand_id', $brandId);
      $id = $productId;
      App\Product::where(compact('id'))->update($editedProduct);
    }

    private function productsTable($brandId)
    {
      $products = $this->getMappedProducts($brandId);
      $categories = App\Category::all();
      $subCategories = App\SubCategory::all();
      $brands = App\Brand::all();
      $priceCategories = App\PriceCategory::all();
      $ageRanges = App\ProductAgeRange::all();
      return view('cms.tables.brand_products_table', compact('categories',
        'subCategories', 'brands', 'priceCategories', 'ageRanges', 'products'));
    }

    private function getMappedProducts($brandId)
    {
      return App\Product::where('brand_id', $brandId)
                        ->latest('updated_at')
                        ->get()
                        ->map(function ($prod) {
                          $product = $prod;
                          $product->category_name = $prod->category()->first()->name;
                          $product->sub_category_name = $prod->subCategory()->first()->name;
                          $product->age_range = $prod->productAgeRange()->first()->range;
                          $product->price_category = $prod->priceCategory()->first()->range;
                          $product->brand_name = $prod->brand()->first()->name;

                          return $product;
                        });
    }


}
