<?php

use Illuminate\Database\Seeder;

class ProductPriceCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('products')
        ->select('id as product_id', 'price_category_id')
        ->get()
        ->map(function($instance) {
          \App\ProductPriceCategories::updateOrCreate([
            'product_id' => $instance->product_id,
            'price_category_id' => $instance->price_category_id,
          ]);
        });
    }
}
