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

    public function real_pictures()
    {
        $images = $this->pictures()->get()->map(function($p){
            return asset('images/real_cloths/' . $p->image_url);
        });

        return $images;
    }

    public function image()
    {
        $url = !is_null($this->pictures()) && !is_null($this->pictures()->first()) ? $this->pictures()->first()->image_url : 'def.png' ;
        return asset('images/real_cloths/' . $url);
    }

    public function brands()
    {
        return $this->belongsToMany('App\Brand', 'product_brands')
                    ->withTimestamps()
                    ->using('App\ProductBrand');
    }

    public function sizes()
    {
      return $this->belongsToMany('App\ProductSize', 'product_has_sizes')
                  ->withTimestamps()
                  ->using('App\ProductHasSize');
    }

    public function ages()
    {
      return $this->belongsToMany('App\ProductAgeRange', 'product_ages')
                  ->withTimestamps()
                  ->using('App\ProductAges');
    }

    public function subCategories()
    {
      return $this->belongsToMany('App\SubCategory', 'product_sub_categories')
                  ->withTimestamps()
                  ->using('App\ProductSubCategories');
    }

    public function categories()
    {
      return $this->belongsToMany('App\Category', 'product_categories')
                  ->withTimestamps()
                  ->using('App\ProductCategories');
    }

    public function priceCategories()
    {
      return $this->belongsToMany('App\PriceCategory', 'product_price_categories')
                  ->withTimestamps()
                  ->using('App\ProductPriceCategories');
    }

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }

    public function present_price(){
        return present_price($this->price);
    }

    public function genderString()
    {
      $gender = '';
      if ($this->gender == 0) {
        $gender = 'Male';
      }
      else if ($this->gender == 1) {
        $gender =  'Female';
      }
      else if ($this->gender == 2) {
        $gender =  'Unisex';
      }
      else {
        $gender =  'null';
      }
      return $gender;
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...
        $array['categories'] = $this->categories()->pluck('name')->toArray();

        $array['sub_categories'] =
                  $this->subCategories()->pluck('name')->toArray();

        $array['brands'] = $this->brands()->pluck('name')->toArray();

        $array['sizes'] = $this->sizes()->pluck('size')->toArray();

        $array['age_ranges'] = $this->ages()->pluck('range')->toArray();

        $array['price_categories'] =
                 $this->priceCategories()->pluck('range')->toArray();

        $array['gender_string'] = $this->genderString();

        return $array;
    }

    public function setStockAttribute($stock)
    {
      $this->stock = ($stock) ? $stock : 0;
    }

}
