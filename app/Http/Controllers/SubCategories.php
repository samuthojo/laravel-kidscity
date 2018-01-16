<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;

class SubCategories extends Controller
{
  private $productImages = 'images/real_cloths/';

  public function cmsIndex()
  {
    $subCategories = $this->getMappedSubCategories();

    $categories = App\Category::all();

    return view('cms.sub_categories', compact('subCategories', 'categories'));
  }

  private function getMappedSubCategories()
  {
    return App\SubCategory::latest('updated_at')
                          ->get()
                          ->map( function($subCat) {
                            $subCategory = $subCat;
                            $subCategory->category =
                              $subCat->category()->withTrashed()->first()->name;
                            return $subCategory;
                          });
  }

  public function products(App\SubCategory $subCategory)
  {
    $products = $subCategory->products()->latest('updated_at')->get()->map(function ($prod) {
      $product = $prod;
      $product->category_name = $prod->category()->withTrashed()->first()->name;
      $product->sub_category_name = $prod->subCategory()->withTrashed()->first()->name;
      $product->age_range = $prod->productAgeRange()->withTrashed()->first()->range;
      $product->price_category = $prod->priceCategory()->withTrashed()->first()->range;
      $product->brand_name = $prod->brand()->withTrashed()->first()->name;

      return $product;
    });

    $categories = App\Category::all();
    $subCategories = App\SubCategory::all();
    $brands = App\Brand::all();
    $priceCategories = App\PriceCategory::all();
    $ageRanges = App\ProductAgeRange::all();
    return view('cms.sub_category_products', compact('subCategory', 'subCategories',
      'categories', 'brands', 'priceCategories', 'ageRanges', 'products'));
  }

  public function store(Requests\CreateSubCategory $request)
  {
    $subCategory = App\SubCategory::create($request->all());
    $subCategories = $this->getMappedSubCategories();
    return view('cms.tables.sub_categories_table', compact('subCategories'));
  }

  public function update(Requests\UpdateSubCategory $request, $id)
  {
    App\SubCategory::where(compact('id'))->update($request->all());
    $subCategories = $this->getMappedSubCategories();
    return view('cms.tables.sub_categories_table', compact('subCategories'));
  }

  public function destroy(App\SubCategory $subCategory)
  {
    $subCategory->delete();
    $subCategories = $this->getMappedSubCategories();
    return view('cms.tables.sub_categories_table', compact('subCategories'));
  }

  public function storeProduct(Requests\CreateSubCategoryProduct $request,
                                $subCategoryId)
  {
    if($request->hasFile('image_url')) {
      $product = $this->saveProductWithImage($request, $subCategoryId);
    }
    else {
      $newProduct = array_add($request->all(), 'sub_category_id', $subCategoryId);
      $product = App\Product::create($newProduct);
    }
    return $this->productsTable($subCategoryId);
  }

  public function updateProduct(Requests\UpdateSubCategoryProduct $request,
                                  $subCategoryId, $productId)
  {
    if($request->hasFile('image_url')) {
      $this->updateProductWithImage($request, $subCategoryId, $productId);
    }
    else {
      $id = $productId;
      $editedProduct = array_add($request->all(), 'sub_category_id', $subCategoryId);
      App\Product::where(compact('id'))->update($editedProduct);
      App\Product::where(compact('id'))->searchable();
    }
    return $this->productsTable($subCategoryId);
  }

  public function deleteProduct($subCategoryId, $productId)
  {
    App\Product::find($productId)->delete();
    return $this->productsTable($subCategoryId);
  }

  private function saveProductWithImage($request, $subCategoryId)
  {
    $imageName = Utils\Utils::saveImage($request->file('image_url'),
                                                        $this->productImages);
    $newProduct = array_add($request->except('image_url'), 'image_url', $imageName);
    $newProduct = array_add($newProduct, 'sub_category_id', $subCategoryId);
    return App\Product::create($newProduct);
  }

  private function updateProductWithImage($request, $subCategoryId, $productId)
  {
    $imageName = Utils\Utils::saveImage($request->file('image_url'),
                                                        $this->productImages);
    $editedProduct = array_add($request->except('image_url'), 'image_url', $imageName);
    $editedProduct = array_add($editedProduct, 'sub_category_id', $subCategoryId);
    $id = $productId;
    App\Product::where(compact('id'))->update($editedProduct);
    App\Product::where(compact('id'))->searchable();
  }

  private function productsTable($subCategoryId)
  {
    $products = $this->getMappedProducts($subCategoryId);
    $categories = App\Category::all();
    $subCategories = App\SubCategory::all();
    $brands = App\Brand::all();
    $priceCategories = App\PriceCategory::all();
    $ageRanges = App\ProductAgeRange::all();
    return view('cms.tables.sub_category_products_table', compact('categories',
      'subCategories', 'brands', 'priceCategories', 'ageRanges', 'products'));
  }

  private function getMappedProducts($subCategoryId)
  {
    return App\Product::where('sub_category_id', $subCategoryId)
                      ->latest('updated_at')
                      ->get()
                      ->map(function ($prod) {
                        $product = $prod;
                        $product->category_name = $prod->category()->withTrashed()->first()->name;
                        $product->sub_category_name = $prod->subCategory()->withTrashed()->first()->name;
                        $product->age_range = $prod->productAgeRange()->withTrashed()->first()->range;
                        $product->price_category = $prod->priceCategory()->withTrashed()->first()->range;
                        $product->brand_name = $prod->brand()->withTrashed()->first()->name;

                        return $product;
                      });
  }

}
