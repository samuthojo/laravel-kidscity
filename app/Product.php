<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, Searchable;

    protected $fillable = [
        'name', 'price', 'description', 'image_url',
        'gender', 'brand_id', 'category_id', 'sub_category_id',
        'price_category_id', 'product_age_range_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function subCategory()
    {
      return $this->belongsTo('App\SubCategory');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function priceCategory()
    {
        return $this->belongsTo('App\PriceCategory');
    }

    public function productAgeRange()
    {
        return $this->belongsTo('App\ProductAgeRange');
    }

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }

    public function present_price(){
        return present_price($this->price);
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...
        $array['category'] = $this->category()->first()->name;
        $array['sub_category'] = $this->subCategory()->first()->name;
        $array['brand'] = $this->brand()->first()->name;
        $array['age_range'] = $this->productAgeRange()->first()->range;
        $array['price_category'] = $this->priceCategory()->first()->range;
        $array['gender_string'] = ($this->gender) ? 'Female' : 'Male';

        return $array;
    }

}
