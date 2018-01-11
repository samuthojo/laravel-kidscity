<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;

class Categories extends Controller
{
    private $productImages = 'images/products/';

    public function cmsIndex()
    {
      $categories = App\Category::all();
      return view('cms.categories', compact('categories'));
    }

    public function products(App\Category $category)
    {
      $products = $category->products()->get()->map(function ($prod) {
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
      return view('cms.category_products', compact('category', 'categories',
        'subCategories', 'brands', 'priceCategories', 'ageRanges', 'products'));
    }

    public function store(Requests\CreateCategory $request)
    {
      $category = App\Category::create($request->all());
      $categories = App\Category::latest('updated_at')->get();
      return view('cms.tables.categories_table', compact('categories'));
    }

    public function update(Requests\UpdateCategory $request, $id)
    {
      App\Category::where('id', $id)->update($request->all());
      $categories = App\Category::latest('updated_at')->get();
      return view('cms.tables.categories_table', compact('categories'));
    }

    public function destroy(App\Category $category)
    {
      $category->delete();
      $categories = App\Category::latest('updated_at')->get();
      return view('cms.tables.categories_table', compact('categories'));
    }

    public function storeProduct(Requests\CreateCategoryProduct $request,
                                  $categoryId)
    {
      if($request->hasFile('image_url')) {
        $product = $this->saveProductWithImage($request, $categoryId);
      }
      else {
        $newProduct = array_add($request->all(), 'category_id', $categoryId);
        $product = App\Product::create($newProduct);
      }
      return $this->productsTable();
    }

    public function updateProduct(Requests\UpdateCategoryProduct $request,
                                    $categoryId, $productId)
    {
      if($request->hasFile('image_url')) {
        $this->updateProductWithImage($request, $categoryId, $productId);
      }
      else {
        $id = $productId;
        $editedProduct = array_add($request->all(), 'category_id', $categoryId);
        App\Product::where(compact('id'))->update($editedProduct);
      }
      return $this->productsTable();
    }

    public function deleteProduct(App\Product $product)
    {
      $product->delete();
      return $this->productsTable();
    }

    private function saveProductWithImage($request, $categoryId)
    {
      $imageName = Utils\Utils::saveImage($request->file('image_url'),
                                                          $this->productImages);
      $newProduct = array_add($request->except('image_url'), 'image_url', $imageName);
      $newProduct = array_add($newProduct, 'category_id', $categoryId);
      return App\Product::create($newProduct);
    }

    private function updateProductWithImage($request, $categoryId, $productId)
    {
      $imageName = Utils\Utils::saveImage($request->file('image_url'),
                                                          $this->productImages);
      $editedProduct = array_add($request->except('image_url'), 'image_url', $imageName);
      $editedProduct = array_add($editedProduct, 'category_id', $categoryId);
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
      return view('cms.tables.category_products_table', compact('categories',
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
