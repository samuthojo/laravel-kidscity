<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      App\Admin::create([
        'name' => 'Admin',
        'email' => env('ADMIN_EMAIL'),
        'phone_number' => env('ADMIN_PHONENUMBER'),
        'password' => Hash::make(env('ADMIN_PASSWORD')),
      ]);
      
    }
}
