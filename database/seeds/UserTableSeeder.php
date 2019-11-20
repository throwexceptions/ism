<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::truncate();
        for ($x = 0; $x <= 200; $x++) {
            $faker = \Faker\Factory::create();
            $email = $faker->unique()->safeEmail;
            \App\User::firstOrCreate(
                [
                    'name'              => $faker->name,
                    'email'             => $email,
                    'email_verified_at' => now(),
                    'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                    'remember_token'    => Str::random(10),
                ]
            );
            print $email . "\n";
        }
    }
}
