<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Utils;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class Products extends Controller
{
    private $productImages;

    public function __construct()
    {
        $this->productImages = App\Product::getImagesLocation();
    }

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
      $categories = App\Category::pluck('name', 'id');
      $productSizes = App\ProductSize::pluck('size', 'id');
      $subCategories = App\SubCategory::pluck('name', 'id');
      $brands = App\Brand::pluck('name', 'id');
      $priceCategories = App\PriceCategory::pluck('range', 'id');
      $ageRanges = App\ProductAgeRange::pluck('range', 'id');
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

      flash('Product created successfully')->success();

      return redirect()->route('products.index');
    }

    private function createProduct($request)
    {

      $product = App\Product::withoutSyncingToSearch(function ()
                                                     use ($request) {

        DB::beginTransaction();

        $product = null;

        try {
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

         DB::commit();
        }
        catch (Throwable $e)
        {
          DB::rollBack();

          return response()->json(["message" => "Error, product not added"], 500);
        }

        return $product;
      });

      //Now Sync With Algolia
      App\Product::where('id', $product->id)->searchable();
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
      $categories = App\Category::pluck('name', 'id');
      $productSizes = App\ProductSize::pluck('size', 'id');
      $subCategories = App\SubCategory::pluck('name', 'id');
      $brands = App\Brand::pluck('name', 'id');
      $priceCategories = App\PriceCategory::pluck('range', 'id');
      $ageRanges = App\ProductAgeRange::pluck('range', 'id');
      $pictures = $product->pictures()->get();
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
                'selectedBrands', 'pictures'));
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

      flash('Product updated successfully')->success();

      return redirect()->route('products.index');
    }

    private function updateProduct($request, $product_id)
    {
      DB::beginTransaction();

      try {
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

       DB::commit();
      }
      catch(Throwable $e)
      {
        DB::rollBack();

        return response()->json(["message" => "Error, product not added"], 500);
      }

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

      }

    public function destroy(App\Product $product)
    {
      //Several events are fired and handled before actual soft-deletion
      $product->delete();

      //return the view
      return $this->productsTable();
    }

    public function replacePicture(Request $request, App\ProductPicture $picture)
    {
        $request->validate([
          'image_url' => 'file|image|max:2048',
        ]);

        //Delete the old picture from the file-system
        unlink(public_path($this->productImages) . $picture->image_url);

        //Save the new picture to the file-system
        $image_url = Utils\Utils::saveImage($request->file('image_url'),
                                                          $this->productImages);

        //Update database reference
        $picture->update(compact('image_url'));
    }

    public function storePictures(Request $request, App\Product $product)
    {
      $request->validate($this->pictureRules($request));

      if($request->hasFile('image_url')) {
        $this->saveAllPictures($request, $product);
      }

      flash('Pictures uploaded successfully')->success();

      return redirect()->route('products.edit', ['product' => $product->id, ]);
    }

    private function pictureRules($request)
    {
      $rules = [];

      $images = count($request->input('image_url')) - 1;
      foreach(range(0, $images) as $index) {
          $rules['image_url.' . $index] = 'nullable|file|image|max:2048';
      }

      return $rules;
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

}
