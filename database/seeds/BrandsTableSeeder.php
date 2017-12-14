<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // $faker = Faker\Factory::create();

      $brands = ['All', 'Phillips', 'Sony G', 'Gucci'];
      foreach ($brands as $brand) {
        App\Brand::create([
          'name' => $brand,
        ]);
      }

    }
}
