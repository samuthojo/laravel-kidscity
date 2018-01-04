<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 5; $i++) {
          App\Order::create([
            'user_id' => $i + 1,
            'delivery_location_id' => $i,
          ]);
          App\OrderItem::create([
            'order_id' => $i,
            'product_id' => $i,
            'quantity' => $i,
          ]);
          if($i == 3) {
            break;
          }
        }
    }
}
