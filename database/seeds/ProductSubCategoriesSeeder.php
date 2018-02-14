<?php

use Illuminate\Database\Seeder;

class ProductSubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('products')
        ->select('id as product_id', 'sub_category_id')
        ->get()
        ->map(function($instance) {
          if($instance->sub_category_id) {
            \App\ProductSubCategories::updateOrCreate([
              'product_id' => $instance->product_id,
              'sub_category_id' => $instance->sub_category_id,
            ]);
          }
        });
    }
}
