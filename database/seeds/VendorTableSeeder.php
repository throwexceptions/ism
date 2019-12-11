<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;
use App\Vendor;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::truncate();
        for($x=0; $x<1000; $x++) {
            $faker = Factory::create();
            $vendor = new Vendor();
            $vendor->name = $faker->firstName;
            $vendor->acct_no = $faker->bankAccountNumber;
            $vendor->phone = $faker->phoneNumber;
            $vendor->other_phone = $faker->phoneNumber;
            $vendor->email = $faker->safeEmail;
            $vendor->fax = $faker->phoneNumber;
            $vendor->website = $faker->domainName;
            $vendor->assigned_to = User::all()->random(2)[0]->id;
            $vendor->parent_company = $faker->company;
            $vendor->credit_limit = '';
            $vendor->credit_available = '';
            $vendor->payment_method = $faker->randomElement(['Credit','Cash','Check','COD']);
            $vendor->tax = '22.3';
            $vendor->tac = $faker->paragraph();
            $vendor->shipping_method = $faker->word;
            $vendor->address = $faker->address;
            $vendor->save();
        }
    }
}
