<?php

use Illuminate\Database\Seeder;

class PriceCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // $faker = Faker\Factory::create();

      $price_categories = ['All', '12,000 - 30,000',
                           '40,000 - 60,000', '70,000 - Above'];
      foreach ($price_categories as $price_category) {
        App\PriceCategory::create([
          'range' => $price_category,
        ]);
      }
    }
}
