<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Supplier::truncate();
        for ($x = 0; $x <= 10000; $x++) {
            $faker             = Faker\Factory::create();
            $supplier          = new \App\Supplier();
            $supplier->name    = $faker->company;
            $supplier->address = $faker->address;
            $supplier->phone   = $faker->phoneNumber;
            $supplier->email   = $faker->companyEmail;
            $supplier->save();
        }
    }
}
