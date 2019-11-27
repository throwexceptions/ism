<?php

use Illuminate\Database\Seeder;

class ShipmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Shipment::truncate();
        for ($x = 0; $x <= 10000; $x++) {
            $user_id = \App\User::all()->random(2)[0]->id;
            $faker                      = Faker\Factory::create();
            $shipment                   = new \App\Shipment();
            $shipment->customer_id      = \App\Customer::all()->random(5)[0]->id;
            $shipment->control_no       = $faker->randomDigit();
            $shipment->dr_no            = $faker->randomDigit();
            $shipment->sales_rep        = $faker->firstName();
            $shipment->delivery_date    = $faker->dateTimeBetween($startDate = 'now', $endDate = '+5 days', $timezone = null);
            $shipment->tin              = $faker->bankAccountNumber();
            $shipment->address          = $faker->address();
            $shipment->created_by       = $user_id;
            $shipment->save();

            $log          = new \App\Log();
            $log->user_id = $user_id;
            $log->remarks = $shipment->id . ' add shipment';
            $log->save();
        }
    }
}
