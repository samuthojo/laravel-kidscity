<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;

class AgeRanges extends Controller
{
    private $productImages = 'images/products/';

    public function cmsIndex()
    {
      $ageRanges = App\ProductAgeRange::latest('updated_at')->get();
      return view('cms.age_ranges', compact('ageRanges'));
    }

    public function products(App\ProductAgeRange $ageRange)
    {
      $products = $ageRange->products()->get()->map(function ($prod) {
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

      return view('cms.age_range_products', compact('ageRange',
        'subCategories', 'categories', 'brands', 'priceCategories',
        'ageRanges', 'products'));
    }

    public function store(Requests\CreateAgeRange $request)
    {
      $ageRange = App\ProductAgeRange::create($request->all());
      $ageRanges = App\ProductAgeRange::latest('updated_at')->get();
      return view('cms.tables.age_ranges_table', compact('ageRanges'));
    }

    public function update(Requests\UpdateAgeRange $request, $id)
    {
      App\ProductAgeRange::where(compact('id'))->update($request->all());
      $ageRanges = App\ProductAgeRange::latest('updated_at')->get();
      return view('cms.tables.age_ranges_table', compact('ageRanges'));
    }

    public function destroy(App\ProductAgeRange $ageRange)
    {
      $ageRange->delete();
      $ageRanges = App\ProductAgeRange::latest('updated_at')->get();
      return view('cms.tables.age_ranges_table', compact('ageRanges'));
    }

    public function storeProduct(Requests\CreateAgeRangeProduct $request,
                                  $ageRangeId)
    {
      if($request->hasFile('image_url')) {
        $product = $this->saveProductWithImage($request, $ageRangeId);
      }
      else {
        $newProduct = array_add($request->all(), 'product_age_range_id', $ageRangeId);
        $product = App\Product::create($newProduct);
      }
      return $this->productsTable();
    }

    public function updateProduct(Requests\UpdateAgeRangeProduct $request,
                                    $ageRangeId, $productId)
    {
      if($request->hasFile('image_url')) {
        $this->updateProductWithImage($request, $ageRangeId, $productId);
      }
      else {
        $id = $productId;
        $editedProduct = array_add($request->all(), 'product_age_range_id', $ageRangeId);
        App\Product::where(compact('id'))->update($editedProduct);
      }
      return $this->productsTable();
    }

    public function deleteProduct(App\Product $product)
    {
      $product->delete();
      return $this->productsTable();
    }

    private function saveProductWithImage($request, $ageRangeId)
    {
      $imageName = Utils\Utils::saveImage($request->file('image_url'),
                                                          $this->productImages);
      $newProduct = array_add($request->except('image_url'), 'image_url', $imageName);
      $newProduct = array_add($newProduct, 'product_age_range_id', $ageRangeId);
      return App\Product::create($newProduct);
    }

    private function updateProductWithImage($request, $ageRangeId, $productId)
    {
      $imageName = Utils\Utils::saveImage($request->file('image_url'),
                                                          $this->productImages);
      $editedProduct = array_add($request->except('image_url'), 'image_url', $imageName);
      $editedProduct = array_add($editedProduct, 'product_age_range_id', $ageRangeId);
      $id = $productId;
      App\Product::where(compact('id'))->update($editedProduct);
    }

    private function productsTable()
    {
      $products = $this->getMappedProducts();
      $categories = App\Category::all();
      $subCategories = App\SubCategory::all();
      $brands = App\Brand::all();
      $priceCategories = App\PriceCategory::all();
      $ageRanges = App\ProductAgeRange::all();
      return view('cms.tables.age_range_products_table', compact('categories',
        'subCategories', 'brands', 'priceCategories', 'ageRanges', 'products'));
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
}
