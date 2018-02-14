<?php

use Illuminate\Database\Seeder;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')
          ->select('id as product_id', 'category_id')
          ->get()
          ->map(function($instance) {
            \App\ProductCategories::updateOrCreate([
              'product_id' => $instance->product_id,
              'category_id' => $instance->category_id,
            ]);
          });
    }
}
