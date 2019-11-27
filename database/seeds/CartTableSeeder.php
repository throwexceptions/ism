<?php

use App\Cart;
use Illuminate\Database\Seeder;

class CartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \App\Cart::truncate();
        for ($x = 0; $x <= 2000; $x++) {
            $faker                = \Faker\Factory::create();
            $cart = new Cart();
            $cart->shipment_id = \App\Shipment::all()->random(5)[0]->id;
            $cart->qty_out = $faker->randomDigit();
            $cart->product_id = \App\Product::all()->random(5)[0]->id;
            $cart->checked_by = '';
            $cart->guard_by = '';
            $cart->is_delivered = '';
            $cart->save();
        }
    }
}
