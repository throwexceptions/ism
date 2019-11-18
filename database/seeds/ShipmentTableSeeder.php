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
            $faker                    = Faker\Factory::create();
            $rec_id = \App\Batch::all()->random(5)[0]->id;
            DB::table('batches')->where('id',$rec_id)->decrement('overall', 100);
            $shipment                 = new \App\Shipment();
            $shipment->batch_id       = $rec_id;
            $shipment->customer_id    = \App\Customer::all()->random(5)[0]->id;
            $shipment->transaction_no = $faker->randomNumber();
            $shipment->date_delivered = $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null);
            $shipment->dr_no          = $faker->randomNumber();
            $shipment->qty_out        = 100;
            $shipment->remarks        = $faker->paragraph();
            $shipment->status         = 'delivered';
            $shipment->save();

            $log          = new \App\Log();
            $log->user_id = \App\User::all()->random(2)[0]->id;
            $log->remarks = $shipment->id . ' add shipment';
            $log->save();
        }
    }
}
