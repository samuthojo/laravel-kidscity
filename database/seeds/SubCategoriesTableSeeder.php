<?php

use Illuminate\Database\Seeder;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // $faker = Faker\Factory::create();
      $categories = App\Category::all();
      $babyProductsSubCategories = ['Walker','Beds', 'Stroller',
                                    'Beds', 'Car Seats', 'High Chairs'];
      $schoolItemsSubCategories = ['School Uniforms', 'School Bags',
                                   'Socks'];
      $shoesSubCategories = ['School', 'Sandals', 'Slippers', 'Fancy'];
      $toysSubCategories = ['Cars', 'MotorBikes', 'Aeroplanes'];

      $index = 0;
      foreach ($categories as $category) {
        if(strcasecmp($category->name, 'Clothing') == 0)
        {
          continue;
        }
        else if(strcasecmp($category->name, 'Baby Products') == 0)
        {
          foreach ($babyProductsSubCategories as $subCategory) {
            App\SubCategory::create([
              'category_id' => $category->id,
              'name' => $subCategory,
            ]);
          }
        }
        else if(strcasecmp($category->name, 'School Items') == 0)
        {
          foreach ($schoolItemsSubCategories as $subCategory) {
            App\SubCategory::create([
              'category_id' => $category->id,
              'name' => $subCategory,
            ]);
          }
        }
        else if(strcasecmp($category->name, 'Shoes') == 0)
        {
          foreach ($shoesSubCategories as $subCategory) {
            App\SubCategory::create([
              'category_id' => $category->id,
              'name' => $subCategory,
            ]);
          }
        }
        else if(strcasecmp($category->name, 'Toys') == 0)
        {
          foreach ($toysSubCategories as $subCategory) {
            App\SubCategory::create([
              'category_id' => $category->id,
              'name' => $subCategory,
            ]);
          }
        }

      }
    }
}
