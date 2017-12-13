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
      $index = 1;
      for ($i = 0; $i < 5; $i++) {
        App\Product::create([
          'brand_id' => $index,
          'category_id' => $index,
          'price_category_id' => $index,
          'name' => "Cloth for Boys " . $i,
          'price' => round(rand(12000, 30000), -3),
          'image_url' => "boy". (($i%9) + 1) .".png",
          'gender' => false, //male
          'description' => 'Lorem ipsum dolor sit amet, consectetur ' .
                           'adipisicing elit. Officiis iure voluptatum, ' .
                           'repellendus reiciendis suscipit, debitis ' .
                           'laboriosam nesciunt.',
        ]);
        $index = (++$index > 3) ? 1 : $index;
      }

      $index = 1;
      for ($i = 0; $i < 4; $i++) {
        App\Product::create([
          'brand_id' => $index,
          'category_id' => $index,
          'price_category_id' => $index,
          'name' => "Girls dressing " . $i,
          'price' => round(rand(12000, 30000), -3),
          'image_url' => "girl". (($i%9) + 1) .".png",
          'gender' => true, //female
          'description' => 'Lorem ipsum dolor sit amet, consectetur ' .
                           'adipisicing elit. Officiis iure voluptatum, ' .
                           'repellendus reiciendis suscipit, debitis ' .
                           'laboriosam nesciunt.',
        ]);
        $index = (++$index > 3) ? 1 : $index;
      }

    }

}
