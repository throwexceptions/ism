<?php

use App\Product;
use App\User;
use Faker\Factory;
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
        for($x=0; $x<1000; $x++) {
            $faker = Factory::create();
            $product = new Product();
            $product->name = $faker->word();
            $product->code = $faker->creditCardNumber();
            $product->category = $faker->word();
            $product->color = $faker->colorName;
            $product->size = $faker->randomFloat();
            $product->weight = $faker->randomFloat();
            $product->sku = $faker->bankAccountNumber;
            $product->manufacturer = $faker->company;
            $product->discontinued = '0';
            $product->assigned_to = User::all()->random(2)[0]->id;
            $product->save();
        }
    }
}
