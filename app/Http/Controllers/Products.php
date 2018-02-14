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
                        ->get()
                        ->map(function ($prod) {
                          $product = $prod;
                          // $product->category_name = $prod->category()
                          //                                ->withTrashed()
                          //                                ->first()->name;
                          // $subCategory = $prod->subCategory()->withTrashed()->first();
                          // $product->sub_category_name = ($subCategory != null) ?
                          //                                          $subCategory->name : "null";
                          // $product->age_range = $prod->productAgeRange()
                          //                            ->withTrashed()
                          //                            ->first()->range;
                          // $product->price_category = $prod->priceCategory()
                          //                                 ->withTrashed()
                          //                                 ->first()->range;
                          // $product->brand_name = $prod->brand()
                          //                             ->withTrashed()
                          //                             ->first()->name;

                          return $product;
                        });
    }

    public function cmsProduct(App\Product $product)
    {
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

        $this->saveProductExtras($request, $product->id);

      });
    }

    private function saveProductExtras($request, $product_id)
    {
      //To save all the brands
      $this->saveBrands($request, $product_id);

      //To save all the categories
      $this->saveCategories($request, $product_id);

      //To save all the subCategories
      if($request->has('sub_category_id'))
      {
        if(count($request->sub_category_id) > 1 || $request->sub_category_id[0]) {
          $this->saveSubCategories($request, $product_id);
        }
      }

      //To save all the priceCategories
      $this->savePriceCategories($request, $product_id);

      //To save all the productAgeRanges
      $this->saveAllAges($request, $product_id);

      //To save all the productSizes
      if($request->has('product_size_id'))
      {
        if(count($request->product_size_id) > 1 || $request->product_size_id[0]) {
          $this->saveAllSizes($request, $product_id);
        }
      }

      //To save all the productPictures
      if($request->hasFile('image_url')) {
        $this->saveAllPictures($request, $product_id);
      }

    }

    private function saveBrands($request, $product_id)
    {
      foreach ($request->brand_id as $brand_id) {
        if($brand_id) {
          App\ProductBrand::create([
            'product_id' => $product_id,
            'brand_id' => $brand_id,
          ]);
        }
      }
    }

    private function saveCategories($request, $product_id)
    {
      foreach ($request->category_id as $category_id) {
        if($category_id) {
          App\ProductCategories::create([
            'product_id' => $product_id,
            'category_id' => $category_id,
          ]);
        }
      }
    }

    private function saveSubCategories($request, $product_id)
    {
      foreach ($request->sub_category_id as $sub_category_id) {
        if($sub_category_id) {
          App\ProductSubCategories::create([
            'product_id' => $product_id,
            'sub_category_id' => $sub_category_id,
          ]);
        }
      }
    }

    private function savePriceCategories($request, $product_id)
    {
      foreach ($request->price_category_id as $price_category_id) {
        if($price_category_id) {
          App\ProductPriceCategories::create([
            'product_id' => $product_id,
            'price_category_id' => $price_category_id,
          ]);
        }
      }
    }

    private function saveAllAges($request, $product_id)
    {
      foreach ($request->product_age_range_id as $product_age_range_id) {
        if($product_age_range_id) {
          App\ProductAges::create([
            'product_id' => $product_id,
            'product_age_range_id' => $product_age_range_id,
          ]);
        }
      }
    }

    private function saveAllSizes($request, $product_id)
    {
      foreach ($request->product_size_id as $product_size_id) {
          if($product_size_id) {
            App\ProductHasSize::create([
              'product_id' => $product_id,
              'product_size_id' => $product_size_id,
            ]);
          }
      }
    }

    private function saveAllPictures($request, $product_id)
    {
      foreach ($request->file('image_url') as $image_url) {
          if($image_url) {
            $image_url = Utils\Utils::saveImage($image_url,
                                                          $this->productImages);
            App\ProductPicture::create([
              'product_id' => $product_id,
              'image_url' => $image_url,
            ]);
          }
      }
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
      $selectedBrands = $product->brands()->pluck('brand_id');

      return $selectedBrands;
    }

    private function getSelectedCategories($product)
    {
      $selectedCategories = $product->categories()->pluck('category_id');

      return $selectedCategories;
    }

    private function getSelectedSubCategories($product)
    {
      $selectedSubCategories = $product->subCategories()
                                       ->pluck('sub_category_id');

      return $selectedSubCategories;
    }

    private function getSelectedPriceCategories($product)
    {
      $selectedPriceCategories = $product->priceCategories()
                                       ->pluck('price_category_id');

      return $selectedPriceCategories;
    }

    private function getSelectedAgeRanges($product)
    {
      $selectedAgeRanges = $product->ages()->pluck('product_age_range_id');

      return $selectedAgeRanges;
    }

    private function getSelectedProductSizes($product)
    {
      $selectedProductSizes = $product->sizes()->pluck('product_size_id');

      return $selectedProductSizes;
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
        $this->updateBrands($request, $product);

        //To update all the categories
        $this->updateCategories($request, $product);

        //To update all the subCategories
        if($request->has('sub_category_id'))
        {
          if(count($request->sub_category_id > 1) || $request->sub_category_id[0])
          {
            $this->updateSubCategories($request, $product);
          }
        }

        //To update all the priceCategories
        $this->updatePriceCategories($request, $product);

        //To update all the productAgeRanges
        $this->updateAllAges($request, $product);

        //To update all the productSizes
        if($request->has('product_size_id'))
        {
          if(count($request->product_size_id > 1) || $request->product_size_id[0])
          {
            $this->updateAllSizes($request, $product);
          }
        }

        //To update all the productPictures
        if($request->hasFile('image_url')) {
          $this->updateAllPictures($request, $product);
        }

      }

        private function updateBrands($request, $product)
        {
          $product->brands()->delete();
          $this->saveBrands($request, $product->id);
        }

        private function updateCategories($request, $product)
        {
          $product->categories()->delete();
          $this->saveCategories($request, $product->id);
        }

        private function updateSubCategories($request, $product)
        {
          if(count($product->subCategories()->get()) > 0) {
            $product->subCategories()->delete();
          }
          $this->saveSubCategories($request, $product->id);
        }

        private function updatePriceCategories($request, $product)
        {
          $product->priceCategories()->delete();
          $this->savePriceCategories($request, $product->id);
        }

        private function updateAllAges($request, $product)
        {
          $product->ages()->delete();
          $this->saveAllAges($request, $product->id);
        }

        private function updateAllSizes($request, $product)
        {
          if(count($product->sizes()->get()) > 0) {
            $product->sizes()->delete();
          }
          $this->saveAllSizes($request, $product->id);
        }

      private function updateAllPictures($request, $product)
      {
        if(count($product->pictures()->get()) > 0) {
          $this->deleteProductPictures($product);
          $product->pictures()->delete();
        }
        $this->saveAllPictures($request, $product->id);
      }

    public function destroy(App\Product $product)
    {
      $this->deleteProductPictures($product);
      $product->delete();
      return $this->productsTable();
    }

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
