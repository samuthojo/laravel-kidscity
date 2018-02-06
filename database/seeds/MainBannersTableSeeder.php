<?php

use Illuminate\Database\Seeder;

class MainBannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \App\MainBanner::create([
        'image_url' => 'kidstar.jpg',
      ]);
    }
}
