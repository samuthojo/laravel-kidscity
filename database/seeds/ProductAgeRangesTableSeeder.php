<?php

use Illuminate\Database\Seeder;

class ProductAgeRangesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // $faker = Faker\Factory::create();

      $ranges = ['0 - 3', '4 - 6', '7 - 9'];
      foreach ($ranges as $range) {
        App\ProductAgeRange::create([
          'range' => $range,
        ]);
      }
    }
}
