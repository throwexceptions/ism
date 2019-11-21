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

            $batch               = new \App\Batch();
            $batch->receivable_id = \App\Receivable::all()->random(2)[0]->id;
            $batch->product_id   = \App\Product::all()->random(5)[0]->id;
            $batch->batch_no     = $faker->randomNumber();
            $batch->qty_in       = $faker->randomDigit();
            $batch->checked_by   = '';
            $batch->approved_by  = '';
            $batch->save();

            $log = new \App\Log();
            $log->user_id = \App\User::all()->random(2)[0]->id;
            $log->remarks = $batch->id.' add batch';
            $log->save();
        }
    }
}
