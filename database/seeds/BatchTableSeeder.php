<?php

use Illuminate\Database\Seeder;

class BatchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Batch::truncate();
        for ($x = 0; $x <= 500; $x++) {
            $faker               = Faker\Factory::create();
            $qty_in              = $faker->randomNumber();
            $batch               = new \App\Batch();
            $batch->product_id   = \App\Product::all()->random(5)[0]->id;
            $batch->customer_id  = \App\Customer::all()->random(5)[0]->id;
            $batch->batch_no     = $faker->randomNumber();
            $batch->container_no = $faker->randomNumber();
            $batch->date_arrival = $faker->dateTimeBetween($startDate = '-3 years', $endDate = '-1 years', $timezone = null);
            $batch->qty_in       = $qty_in;
            $batch->overall      = $qty_in;
            $batch->remarks      = $faker->paragraph();
            $batch->save();

            $log = new \App\Log();
            $log->user_id = \App\User::all()->random(2)[0]->id;
            $log->remarks = $batch->id.' add batch';
            $log->save();
        }
    }
}
