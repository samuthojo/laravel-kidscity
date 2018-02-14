<?php

use Illuminate\Database\Seeder;

class ProductAgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('products')
        ->select('id as product_id', 'product_age_range_id')
        ->get()
        ->map(function($instance) {
          \App\ProductAges::updateOrCreate([
            'product_id' => $instance->product_id,
            'product_age_range_id' => $instance->product_age_range_id,
          ]);
        });
    }
}
