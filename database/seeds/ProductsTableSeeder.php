<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $brand_ids = \App\Brand::all()->modelKeys();
      $category_ids = \App\Category::all()->modelKeys();
      $price_category_ids = \App\PriceCategory::all()->modelKeys();
      $product_age_range_ids = \App\ProductAgeRange::all()->modelKeys();

      for ($i = 0; $i < 5; $i++) {
        App\Product::create([
          'brand_id' => array_random($brand_ids),
          'category_id' => array_random($category_ids),
          'price_category_id' => array_random($price_category_ids),
          'product_age_range_id' => array_random($product_age_range_ids),
          'name' => "Cloth for Boys " . ($i + 1),
          'price' => round(rand(12000, 30000), -3),
          'image_url' => "boy". (($i%9) + 1) .".png",
          'gender' => false, //male
          'description' => 'Lorem ipsum dolor sit amet, consectetur ' .
                           'adipisicing elit. Officiis iure voluptatum, ' .
                           'repellendus reiciendis suscipit, debitis ' .
                           'laboriosam nesciunt.',
        ]);
      }

      for ($i = 0; $i < 4; $i++) {
        App\Product::create([
          'brand_id' => array_random($brand_ids),
          'category_id' => array_random($category_ids),
          'price_category_id' => array_random($price_category_ids),
          'product_age_range_id' => array_random($product_age_range_ids),
          'name' => "Girls dressing " . ($i + 1),
          'price' => round(rand(12000, 30000), -3),
          'image_url' => "girl". (($i%9) + 1) .".png",
          'gender' => true, //female
          'description' => 'Lorem ipsum dolor sit amet, consectetur ' .
                           'adipisicing elit. Officiis iure voluptatum, ' .
                           'repellendus reiciendis suscipit, debitis ' .
                           'laboriosam nesciunt.',
        ]);
      }

    }

}
