<?php

use Illuminate\Database\Seeder;

class ReceivableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Receivable::truncate();
        for ($x = 0; $x <= 500; $x++) {
            $faker               = Faker\Factory::create();

            $receivable                 = new \App\Receivable();
            $receivable->supplier_id    = \App\Supplier::all()->random(2)[0]->id;
            $receivable->control_no       = $faker->randomNumber();
            $receivable->container_no       = $faker->randomNumber();
            $receivable->po                 = $faker->randomNumber();
            $receivable->so                 = $faker->randomNumber();
            $receivable->delivery_advice = $faker->randomNumber();
            $receivable->date_arrival = $faker->dateTimeBetween($startDate = '-5 days', $endDate='+ 2 days');
            $receivable->remarks      = $faker->sentence();
            $receivable->created_by   = \App\User::all()->random(2)[0]->id;
            $receivable->save();

            $log = new \App\Log();
            $log->user_id = \App\User::all()->random(2)[0]->id;
            $log->remarks = $receivable->id.' add receivable';
            $log->save();
        }
    }
}
