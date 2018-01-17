<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // $faker = Faker\Factory::create();

      $categories = ['Clothing', 'Baby Products', 'School Items',
                     'Toys', 'Shoes'];
      foreach ($categories as $category) {
        App\Category::create([
          'name' => $category,
        ]);
      }

    }
}
