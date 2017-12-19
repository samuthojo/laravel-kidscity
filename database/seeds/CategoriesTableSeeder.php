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

      $categories = ['Kids Wear', 'School Uniforms', 'Accessories'];
      foreach ($categories as $category) {
        App\Category::create([
          'name' => $category,
        ]);
      }

    }
}
