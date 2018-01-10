<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Utils;
use App\Http\Requests;

class Products extends Controller
{
    private $productImages = 'images/products/';

    public function product(App\Product $product)
    {
      $page = 'shop';
      $back = true;

      return view('product_detail', compact('page', 'back', 'product'));
    }

    public function cmsIndex()
    {
      $products = $this->getMappedProducts();

      $categories = App\Category::all();
      $subCategories = App\SubCategory::all();
      $brands = App\Brand::all();
      $priceCategories = App\PriceCategory::all();
      $ageRanges = App\ProductAgeRange::all();
      return view('cms.products', compact('categories', 'subCategories',
        'brands', 'priceCategories', 'ageRanges', 'products'));
    }

    private function getMappedProducts()
    {
      return App\Product::latest('updated_at')
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

    public function cmsProduct(App\Product $product)
    {
      return $product;
    }

    public function store(Requests\CreateProduct $request)
    {
      if($request->hasFile('image_url')) {
        $product = $this->saveProductWithImage($request);
      }
      else {
        $product = App\Product::create($request->all());
      }
      return $this->productsTable();
    }

    public function update(Requests\UpdateProduct $request, $id)
    {
      if($request->hasFile('image_url')) {
        $this->updateProductWithImage($request, $id);
      }
      else {
        App\Product::where(compact('id'))->update($request->all());
      }
      return $this->productsTable();
    }

    public function destroy(App\Product $product)
    {
      $product->delete();
      return $this->productsTable();
    }

    private function productsTable()
    {
      $products = $this->getMappedProducts();
      $categories = App\Category::all();
      $subCategories = App\SubCategory::all();
      $brands = App\Brand::all();
      $priceCategories = App\PriceCategory::all();
      $ageRanges = App\ProductAgeRange::all();
      return view('cms.tables.products_table', compact('categories',
        'subCategories', 'brands', 'priceCategories', 'ageRanges', 'products'));
    }

    private function saveProductWithImage($request)
    {
      $imageName = Utils\Utils::saveImage($request->file('image_url'),
                                                          $this->productImages);
      $newProduct = array_add($request->except('image_url'), 'image_url', $imageName);
      return App\Product::create($newProduct);
    }

    private function updateProductWithImage($request, $id)
    {
      $imageName = Utils\Utils::saveImage($request->file('image_url'),
                                                          $this->productImages);
      $editedProduct = array_add($request->except('image_url'), 'image_url', $imageName);
      App\Product::where(compact('id'))->update($editedProduct);
    }
}
