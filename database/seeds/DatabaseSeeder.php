<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SubCategoriesTableSeeder::class);
        $this->call(PriceCategoriesTableSeeder::class);
        $this->call(DeliveryLocationsTableSeeder::class);
        $this->call(ProductAgeRangesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductColorsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderItemsTableSeeder::class);
    }
}
