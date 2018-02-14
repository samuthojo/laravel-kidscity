<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Product extends Model
{
    use Searchable, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['pictures', 'sizes', 'subCategories',
                                 'ages', 'categories', 'brands',
                                 'priceCategories'];

    protected $fillable = [
        'name', 'price', 'description', 'sale_price',
        'gender', 'stock', 'weight', 'dimensions',
        'video_url', 'code', 'barcode',
    ];

    // public function category()
    // {
    //     return $this->belongsTo('App\Category');
    // }
    //
    // public function subCategory()
    // {
    //   return $this->belongsTo('App\SubCategory');
    // }

    public function brands()
    {
        return $this->hasMany('App\ProductBrand');
    }

    // public function priceCategory()
    // {
    //     return $this->belongsTo('App\PriceCategory');
    // }

    // public function productAgeRange()
    // {
    //     return $this->belongsTo('App\ProductAgeRange');
    // }

    public function pictures()
    {
      return $this->hasMany('App\ProductPicture');
    }

    public function sizes()
    {
      return $this->hasMany('App\ProductHasSize');
    }

    public function ages()
    {
      return $this->hasMany('App\ProductAges');
    }

    public function subCategories()
    {
      return $this->hasMany('App\ProductSubCategories');
    }

    public function categories()
    {
//      return $this->hasMany('App\ProductCategories');
      return $this->belongsToMany('App\Category', 'product_categories')->using('App\ProductCategories');
    }

    public function priceCategories()
    {
      return $this->hasMany('App\ProductPriceCategories');
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
