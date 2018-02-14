<?php

use Illuminate\Database\Seeder;

class ProductPicturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('products')
        ->select('id as product_id', 'image_url')
        ->get()
        ->map(function($instance) {
          if($instance->image_url) {
            \App\ProductPicture::updateOrCreate([
              'product_id' => $instance->product_id,
              'image_url' => $instance->image_url,
            ]);
          }
        });
    }
}
