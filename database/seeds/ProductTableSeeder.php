<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Product::truncate();
        for ($x = 0; $x <= 2000; $x++) {
            $faker              = Faker\Factory::create();
            $product            = new \App\Product();
            $product->name      = $faker->bankAccountNumber;
            $product->size      = $faker->randomNumber();
            $product->thickness = $faker->randomFloat();
            $product->pack_qty  = '45';
            $product->type      = 'Pcs./Box';
            $product->save();

            $log = new \App\Log();
            $log->user_id = \App\User::all()->random(2)[0]->id;
            $log->remarks = $product->id.' add product';
            $log->save();
        }
    }
}
