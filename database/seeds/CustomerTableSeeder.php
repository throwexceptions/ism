<?php

use App\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory;
use App\User;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Customer::truncate();
        for($x=0; $x<3000; $x++) {
            $faker = Factory::create();
            $customer = new Customer();
            $customer->acc_name = $faker->company;
            $customer->phone = $faker->phoneNumber;
            $customer->other_phone = $faker->phoneNumber;
            $customer->email = $faker->freeEmail;
            $customer->parent_company = $faker->company;
            $customer->acc_no = $faker->bankAccountNumber;
            $customer->website = $faker->domainName;
            $customer->fax = $faker->phoneNumber;
            $customer->employees = $faker->randomDigit;
            $customer->ownership = $faker->paragraph();
            $customer->industry = $faker->word();
            $customer->sales_manager = $faker->firstName();
            $customer->assigned_to = User::all()->random(2)[0]->id;;
            $customer->sales_person = $faker->firstName();
            $customer->acc_status = $faker->word();
            $customer->tax_id = $faker->creditCardNumber;
            $customer->reseller_id = $faker->randomNumber();
            $customer->payment_method = $faker->word();
            $customer->tac = $faker->paragraph();
            $customer->address = $faker->address;
            $customer->description = $faker->paragraph();
            $customer->save();
        }
    }
}
