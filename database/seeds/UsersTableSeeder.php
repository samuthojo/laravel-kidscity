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
      $faker = Faker\Factory::create();

        App\User::create([
          'name' => 'Admin',
          'phone_number' => env('ADMIN_PHONENUMBER'),
          'password' => Hash::make(env('ADMIN_PASSWORD')),
          'is_admin' => env('IS_ADMIN'),
        ]);

        for($i = 0; $i < 5; $i++) {
          App\User::create([
            'phone_number' => $faker->phoneNumber,
            'name' => $faker->name
          ]);
        }
    }
}
