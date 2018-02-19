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

      for($i = 0; $i < 5; $i++) {
        App\User::create([
          'phone_number' => $faker->phoneNumber,
          'name' => $faker->name,
          'password' => Hash::make(str_random(32)),
        ]);
      }
    }
}
