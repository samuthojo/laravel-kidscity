<?php

use Illuminate\Database\Seeder;

class AdvertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Advert::create([
          'image_url' => 'wide-ad.png',
        ]);
    }
}
