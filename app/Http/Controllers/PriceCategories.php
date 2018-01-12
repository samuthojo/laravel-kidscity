<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;

class PriceCategories extends Controller
{
    private $productImages = 'images/products/';

    public function cmsIndex()
    {
      $priceCategories = App\PriceCategory::latest('updated_at')->get();
      return view('cms.price_categories', compact('priceCategories'));
    }

    public function products(App\PriceCategory $priceCategory)
    {
      $products = $priceCategory->products()->get()->map(function ($prod) {
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

      return view('cms.price_category_products', compact('priceCategory',
        'subCategories', 'categories', 'brands', 'priceCategories',
        'ageRanges', 'products'));
    }

    public function store(Requests\CreatePriceCategory $request)
    {
      $priceCategory = App\PriceCategory::create($request->all());
      $priceCategories = App\PriceCategory::latest('updated_at')->get();
      return view('cms.tables.price_categories_table', compact('priceCategories'));
    }

    public function update(Requests\UpdatePriceCategory $request, $id)
    {
      App\PriceCategory::where(compact('id'))->update($request->all());
      $priceCategories = App\PriceCategory::latest('updated_at')->get();
      return view('cms.tables.price_categories_table', compact('priceCategories'));
    }

    public function destroy(App\PriceCategory $priceCategory)
    {
      $priceCategory->delete();
      $priceCategories = App\PriceCategory::latest('updated_at')->get();
      return view('cms.tables.price_categories_table', compact('priceCategories'));
    }

    public function storeProduct(Requests\CreatePriceCategoryProduct $request,
                                  $priceCategoryId)
    {
      if($request->hasFile('image_url')) {
        $product = $this->saveProductWithImage($request, $priceCategoryId);
      }
      else {
        $newProduct = array_add($request->all(), 'price_category_id', $priceCategoryId);
        $product = App\Product::create($newProduct);
      }
      return $this->productsTable($priceCategoryId);
    }

    public function updateProduct(Requests\UpdatePriceCategoryProduct $request,
                                    $priceCategoryId, $productId)
    {
      if($request->hasFile('image_url')) {
        $this->updateProductWithImage($request, $priceCategoryId, $productId);
      }
      else {
        $id = $productId;
        $editedProduct = array_add($request->all(), 'price_category_id', $priceCategoryId);
        App\Product::where(compact('id'))->update($editedProduct);
      }
      return $this->productsTable($priceCategoryId);
    }

    public function deleteProduct($priceCategoryId, $productId)
    {
      App\Product::find($productId)->delete();
      return $this->productsTable($priceCategoryId);
    }

    private function saveProductWithImage($request, $priceCategoryId)
    {
      $imageName = Utils\Utils::saveImage($request->file('image_url'),
                                                          $this->productImages);
      $newProduct = array_add($request->except('image_url'), 'image_url', $imageName);
      $newProduct = array_add($newProduct, 'price_category_id', $priceCategoryId);
      return App\Product::create($newProduct);
    }

    private function updateProductWithImage($request, $priceCategoryId, $productId)
    {
      $imageName = Utils\Utils::saveImage($request->file('image_url'),
                                                          $this->productImages);
      $editedProduct = array_add($request->except('image_url'), 'image_url', $imageName);
      $editedProduct = array_add($editedProduct, 'price_category_id', $priceCategoryId);
      $id = $productId;
      App\Product::where(compact('id'))->update($editedProduct);
    }

    private function productsTable($priceCategoryId)
    {
      $products = $this->getMappedProducts($priceCategoryId);
      $categories = App\Category::all();
      $subCategories = App\SubCategory::all();
      $brands = App\Brand::all();
      $priceCategories = App\PriceCategory::all();
      $ageRanges = App\ProductAgeRange::all();
      return view('cms.tables.price_category_products_table', compact('categories',
        'subCategories', 'brands', 'priceCategories', 'ageRanges', 'products'));
    }

    private function getMappedProducts($priceCategoryId)
    {
      return App\Product::where('price_category_id', $priceCategoryId)
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
