<?php

use Illuminate\Database\Seeder;

class ProductBrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('products')
        ->select('id as product_id', 'brand_id')
        ->get()
        ->map(function($instance) {
          \App\ProductBrand::updateOrCreate([
            'product_id' => $instance->product_id,
            'brand_id' => $instance->brand_id,
          ]);
        });
    }
}
