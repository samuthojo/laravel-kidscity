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
      $brands = ['Baby Jogger', 'Britax Romer', 'Bugaboo', 'Disney', 'Ergobaby', 'LGS', 'Medela', 'Munchkin',
          'Phillips', 'Silver Cross', 'Skip Hop', 'Uppa Baby', 'Vtech'];
      $i = 1;
      foreach ($brands as $brand) {
          $brand_image = strtolower(str_replace(" ", "", $brand));
        App\Brand::create([
          'name' => $brand,
          'image_url' => $brand_image . '_logo.png'
        ]);
        $i++;
      }
    }
}
