<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker   = Factory::create();
        $genders = ['male', 'female'];

        User::create([
            'name'              => $faker->name,
            'last_name'         => $faker->lastName,
            'family_name'       => $faker->lastName,
            'email'             => 'user@gmail.com',
            'password'          => bcrypt('password'),
            'birthdate'         => $faker->date,
            'address'           => $faker->address,
            'phone_number'      => $faker->phoneNumber,
            'gender'            => $genders[array_rand($genders)],
        ]);

        User::create([
            'name'              => $faker->name,
            'last_name'         => $faker->lastName,
            'family_name'       => $faker->lastName,
            'email'             => 'root@gmail.com',
            'password'          => bcrypt('password'),
            'birthdate'         => $faker->date,
            'address'           => $faker->address,
            'phone_number'      => $faker->phoneNumber,
            'gender'            => $genders[array_rand($genders)],
        ]);
    }
}
