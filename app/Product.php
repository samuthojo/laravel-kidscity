<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Product extends Model
{
    use Searchable, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['pictures'];

    protected $fillable = [
        'name', 'price', 'description', 'sale_price',
        'gender', 'stock', 'weight', 'dimensions',
        'video_url', 'code', 'barcode',
    ];

    public function pictures()
    {
      return $this->hasMany('App\ProductPicture');
    }

    public function brands()
    {
        return $this->belongsToMany('App\Brand', 'product_brands')
                    ->using('App\ProductBrand');
    }

    public function sizes()
    {
      return $this->belongsToMany('App\ProductSize', 'product_has_sizes')
                  ->using('App\ProductHasSize');
    }

    public function ages()
    {
      return $this->belongsToMany('App\ProductAgeRange', 'product_ages')
                  ->using('App\ProductAges');
    }

    public function subCategories()
    {
      return $this->belongsToMany('App\SubCategory', 'product_sub_categories')
                  ->using('App\ProductSubCategories');
    }

    public function categories()
    {
      return $this->belongsToMany('App\Category', 'product_categories')
                  ->using('App\ProductCategories');
    }

    public function priceCategories()
    {
      return $this->belongsToMany('App\PriceCategory', 'product_price_categories')
                  ->using('App\ProductPriceCategories');
    }

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }

    public function present_price(){
        return present_price($this->price);
    }

    public function image()
    {
        return asset('images/real_cloths/' . $this->pictures()->first()->image_url);
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...
        // $array['category'] = $this->category()->withTrashed()->first()->name;
        // $subCategory = $this->subCategory()->withTrashed()->first();
        // $array['sub_category'] = ($subCategory != null) ?
        //                                           $subCategory->name : "null";
        // $array['brand'] = $this->brand()->withTrashed()->first()->name;
        // $array['age_range'] = $this->productAgeRange()->withTrashed()->first()->range;
        // $array['price_category'] = $this->priceCategory()->withTrashed()->first()->range;
        $array['gender_string'] = ($this->gender) ? 'Female' : 'Male';

        return $array;
    }

    public function setStockAttribute($stock)
    {
      $this->stock = ($stock) ? $stock : 0;
    }

}
