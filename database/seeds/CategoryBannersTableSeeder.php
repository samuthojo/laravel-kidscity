<?php

use Illuminate\Database\Seeder;

class CategoryBannersTableSeeder extends Seeder
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
            'name' => 'For Boys',
            'image_url' => 'featured-boys.jpg',
          ],
          [
            'name' => 'For Girls',
            'image_url' => 'featured-girls.jpg',
          ],
          [
            'name' => 'For Babies',
            'image_url' => 'featured_baby.jpg',
          ],
        ];
      foreach ($banners as $banner) {
        \App\CategoryBanner::create($banner);
      }
    }
}
