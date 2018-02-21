<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Utils;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class Products extends Controller
{
    private $productImages = 'images/real_cloths/';

    private $firstImageName = "";

    public function product(App\Product $product)
    {
      $page = 'shop';
      $back = true;
      $images = [];

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

    public function create()
    {
      $categories = \App\Category::pluck('name', 'id');
      $productSizes = \App\ProductSize::pluck('size', 'id');
      $subCategories = \App\SubCategory::pluck('name', 'id');
      $brands = \App\Brand::pluck('name', 'id');
      $priceCategories = \App\PriceCategory::pluck('range', 'id');
      $ageRanges = \App\ProductAgeRange::pluck('range', 'id');
      $selectedSubCategory = null;
      $selectedBrands = null;
      $selectedCategories = null;
      $selectedSubCategories = null;
      $selectedPriceCategories = null;
      $selectedAgeRanges = null;
      $selectedProductSizes = null;
      $selectedGender = null;
      $editForm = false;
      return view('cms.products.add_product',
        compact('categories', 'subCategories', 'brands',
                'priceCategories', 'ageRanges',
                'selectedSubCategory', 'productSizes', 'editForm',
                'selectedSubCategories', 'selectedCategories',
                'selectedPriceCategories', 'selectedAgeRanges',
                'selectedProductSizes', 'selectedGender',
                'selectedBrands'));
    }

    private function getMappedProducts()
    {
      return App\Product::latest('updated_at')
                        ->with([
                          'brands:name', 'categories:name', 'ages:range',
                          'sizes:size', 'subCategories:name',
                          'priceCategories:range',
                          ])->get();
    }

    public function cmsProduct(App\Product $product)
    {
        $picture = $product->pictures()->first();

        $product->image_url = ($picture) ? $picture->image_url : null;

        return $product;
    }

    public function store(Requests\CreateProduct $request)
    {
      $this->createProduct($request);

      return redirect()->route('products.index');
    }

    private function createProduct($request)
    {
      DB::transaction(function () use($request) {

         $product = App\Product::create([
          'code' => $request->code,
          'barcode' => $request->barcode,
          'name' => $request->name,
          'description' => $request->description,
          'price' => $request->price,
          'sale_price' => $request->sale_price,
          'stock' => $request->stock,
          'gender' => $request->gender,
          'video_url' => $request->video_url,
          'dimensions' => $request->dimensions,
          'weight' => $request->weight,
        ]);

        $this->saveProductExtras($request, $product);

      });
    }

    private function saveProductExtras($request, $product)
    {
      //To save all the brands
      $this->saveBrands($request, $product);

      //To save all the categories
      $this->saveCategories($request, $product);

      //To save all the subCategories
      if($request->has('sub_category_id'))
      {
        $this->saveSubCategories($request, $product);
      }

      //To save all the priceCategories
      $this->savePriceCategories($request, $product);

      //To save all the productAgeRanges
      $this->saveAllAges($request, $product);

      //To save all the productSizes
      if($request->has('product_size_id'))
      {
        $this->saveAllSizes($request, $product);
      }

      //To save all the productPictures
      if($request->hasFile('image_url')) {
        $this->saveAllPictures($request, $product);
      }

    }

    private function saveBrands($request, $product)
    {
      $product->brands()->sync($request->brand_id);
    }

    private function saveCategories($request, $product)
    {
      $product->categories()->sync($request->category_id);
    }

    private function saveSubCategories($request, $product)
    {
      $product->subCategories()->sync($request->sub_category_id);
    }

    private function savePriceCategories($request, $product)
    {
      $product->priceCategories()->sync($request->price_category_id);
    }

    private function saveAllAges($request, $product)
    {
      $product->ages()->sync($request->product_age_range_id);
    }

    private function saveAllSizes($request, $product)
    {
      $product->sizes()->sync($request->product_size_id);
    }

    private function saveAllPictures($request, $product)
    {
      $destination = $this->productImages;

      $image_urls = collect($request->file('image_url'))
                             ->map( function($image_url)
                             use ($destination, $product)
                             {
                               if($image_url)
                               {
                                 return [
                                         'image_url' =>
                                            Utils\Utils::saveImage($image_url,
                                                                  $destination)
                                        ];
                               }
                             });

      $product->pictures()->createMany($image_urls->toArray());

    }

    public function edit(App\Product $product)
    {
      $categories = \App\Category::pluck('name', 'id');
      $productSizes = \App\ProductSize::pluck('size', 'id');;
      $subCategories = \App\SubCategory::pluck('name', 'id');
      $brands = \App\Brand::pluck('name', 'id');
      $priceCategories = \App\PriceCategory::pluck('range', 'id');
      $ageRanges = \App\ProductAgeRange::pluck('range', 'id');
      $selectedSubCategory = null;

      $selectedBrands = $this->getSelectedBrands($product);

      $selectedCategories = $this->getSelectedCategories($product);

      $selectedSubCategories = $this->getSelectedSubCategories($product);

      $selectedPriceCategories = $this->getSelectedPriceCategories($product);

      $selectedAgeRanges = $this->getSelectedAgeRanges($product);

      $selectedProductSizes = $this->getSelectedProductSizes($product);

      $selectedGender = $product->gender;

      $editForm = true;

      return view('cms.products.edit_product',
        compact('product', 'categories', 'productSizes', 'subCategories',
                'brands', 'priceCategories', 'ageRanges',
                'selectedSubCategory', 'editForm', 'selectedSubCategories',
                'selectedCategories', 'selectedPriceCategories',
                'selectedAgeRanges', 'selectedProductSizes', 'selectedGender',
                'selectedBrands'));
    }

    private function getSelectedBrands($product)
    {
      return $product->brands()->pluck('brand_id');
    }

    private function getSelectedCategories($product)
    {
      return $product->categories()->pluck('category_id');
    }

    private function getSelectedSubCategories($product)
    {
      return $product->subCategories()->pluck('sub_category_id');
    }

    private function getSelectedPriceCategories($product)
    {
      return $product->priceCategories()->pluck('price_category_id');
    }

    private function getSelectedAgeRanges($product)
    {
      return $product->ages()->pluck('product_age_range_id');
    }

    private function getSelectedProductSizes($product)
    {
      return $product->sizes()->pluck('product_size_id');
    }

    public function update(Requests\UpdateProduct $request, $product_id)
    {
      $this->updateProduct($request, $product_id);

      App\Product::where('id', $product_id)->searchable(); //Sync With Algolia

      return redirect()->route('products.index');
    }

    private function updateProduct($request, $product_id)
    {
      DB::transaction(function () use($request,
                                      $product_id) {

         App\Product::where('id', $product_id)
                    ->update([
                      'code' => $request->code,
                      'barcode' => $request->barcode,
                      'name' => $request->name,
                      'description' => $request->description,
                      'price' => $request->price,
                      'sale_price' => $request->sale_price,
                      'stock' => $request->stock,
                      'gender' => $request->gender,
                      'video_url' => $request->video_url,
                      'dimensions' => $request->dimensions,
                      'weight' => $request->weight,
                    ]);

        $this->updateProductExtras($request, $product_id);

      });
    }


      private function updateProductExtras($request, $product_id)
      {
        $product = App\Product::find($product_id);

        //To update all the brands
        $this->saveBrands($request, $product);

        //To update all the categories
        $this->saveCategories($request, $product);

        //To update all the subCategories
        if($request->has('sub_category_id'))
        {
          $this->saveSubCategories($request, $product);
        }

        //To update all the priceCategories
        $this->savePriceCategories($request, $product);

        //To update all the productAgeRanges
        $this->saveAllAges($request, $product);

        //To update all the productSizes
        if($request->has('product_size_id'))
        {
          $this->saveAllSizes($request, $product);
        }

        //To update all the productPictures
        if($request->hasFile('image_url')) {
          $this->updateAllPictures($request, $product);
        }

      }

    private function updateAllPictures($request, $product)
    {
      if(count($product->pictures()->get()) > 0) {
        //delete the pictures from the file-system
        $this->deleteProductPictures($product);
        //remove the database references
        $product->pictures()->delete();
      }
      $this->saveAllPictures($request, $product);
    }

    public function destroy(App\Product $product)
    {
      //Delete its pictures from file system
      $this->deleteProductPictures($product);
      //Detach this product from all its relationships
      $this->detachProduct($product);
      //Now delete the product
      $product->delete();
      //return the view
      return $this->productsTable();
    }

    //Detaches this product from all its relationships
    private function detachProduct($product)
    {
      //Detach from brands
      $this->detachFromBrands($product);

      //Detach from categories
      $this->detachFromCategories($product);

      //Detach from sub_categories
      $this->detachFromSubCategories($product);

      //Detach from price_categories
      $this->detachFromPriceCategories($product);

      //Detach from ages
      $this->detachFromAges($product);

      //Detach from sizes
      $this->detachFromSizes($product);
    }

    private function detachFromBrands($product)
    {
      $product->brands()->detach();
    }

    private function detachFromCategories($product)
    {
      $product->categories()->detach();
    }

    private function detachFromSubCategories($product)
    {
      $product->subCategories()->detach();
    }

    private function detachFromPriceCategories($product)
    {
      $product->priceCategories()->detach();
    }

    private function detachFromAges($product)
    {
      $product->ages()->detach();
    }

    private function detachFromSizes($product)
    {
      $product->sizes()->detach();
    }

    //deletes pictures from the file-system
    private function deleteProductPictures($product)
    {
      $base_path = public_path($this->productImages);
      $product->pictures()
              ->get()->map(function($picture)
                use ($base_path){
                unlink($base_path . $picture->image_url);
              });
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
      App\Product::where(compact('id'))->searchable();
    }
}
