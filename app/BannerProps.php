<?php
/**
 * Created by PhpStorm.
 * User: Waky
 * Date: 2/20/2018
 * Time: 1:52 PM
 */

namespace App;


trait BannerProps
{
    public static function current(){
        return static::first();
    }

    public function image(){
        return asset('images/' . $this->image_url);
    }

    public static function banner_list(){
        return static::all();
    }
}