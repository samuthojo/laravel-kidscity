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
        //$this->call(UsersTableSeeder::class);
        //$this->call(BrandsTableSeeder::class);
        //$this->call(CategoriesTableSeeder::class);
        //$this->call(SubCategoriesTableSeeder::class);
        //$this->call(PriceCategoriesTableSeeder::class);
        //$this->call(DeliveryLocationsTableSeeder::class);
        //$this->call(ProductAgeRangesTableSeeder::class);
        //$this->call(ProductsTableSeeder::class);
        //$this->call(ProductColorsTableSeeder::class);
        //$this->call(OrdersTableSeeder::class);
        //$this->call(OrderItemsTableSeeder::class);
        //$this->call(AdvertsTableSeeder::class);
        //$this->call(MainBannersTableSeeder::class);
        //$this->call(FeaturedBannersTableSeeder::class);
        //$this->call(CategoryBannersTableSeeder::class);

        $this->call(ProductCategoriesSeeder::class);
        $this->call(ProductPicturesSeeder::class);
        $this->call(ProductPriceCategoriesSeeder::class);
        $this->call(ProductSubCategoriesSeeder::class);
        $this->call(ProductPriceCategoriesSeeder::class);
        $this->call(BrandsTableSeeder::class);
        $this->call(ProductAgesSeeder::class);
    }
}
