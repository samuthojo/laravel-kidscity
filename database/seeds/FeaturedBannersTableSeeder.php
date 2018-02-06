<?php

use Illuminate\Database\Seeder;

class FeaturedBannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $banners = [
          [
            'name' => 'Best Seller',
            'image_url' => 'pram.jpg',
          ],
          [
            'name' => 'Accessories',
            'image_url' => 'pram2.jpg',
          ],
          [
            'name' => 'Kids Fun',
            'image_url' => 'toy2.jpg',
          ],
        ];
      foreach ($banners as $banner) {
        \App\FeaturedBanner::create($banner);
      }
    }

}
