<?php

use Illuminate\Database\Seeder;

class DeliveryLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = ['Kinondoni', 'Ilala', 'Temeke', ];
        $prices = [15000, 20000, 25000];

        for($i = 0; $i < 3; $i++) {
          App\DeliveryLocation::create([
            'location' => $locations[$i],
            'delivery_price' => $prices[$i],
          ]);
        }
    }
}
