<?php

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Customer::truncate();
        for ($x = 0; $x <= 100; $x++) {
            $faker                = \Faker\Factory::create();
            $customer             = new \App\Customer();
            $customer->name       = $faker->company;
            $customer->address    = $faker->companyEmail;
            $customer->contact_no = $faker->phoneNumber;
            $customer->email      = $faker->safeEmail;
            $customer->save();

            $log = new \App\Log();
            $log->user_id = \App\User::all()->random(2)[0]->id;
            $log->remarks = $customer->id.' add customer';
            $log->save();
        }
    }
}
