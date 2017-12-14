<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
          'phone_number' => env('ADMIN_PHONENUMBER'),
          'password' => Hash::make(env('ADMIN_PASSWORD')),
        ]);
    }
}
