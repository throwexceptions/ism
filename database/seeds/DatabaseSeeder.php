<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductTableSeeder::class);
        $this->call(VendorTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(SupplyTableSeeder::class);
        $this->call(PurchaseInfoTableSeeder::class);
        $this->call(SalesOrderTableSeeder::class);
        $this->call(ProductDetailTableSeeder::class);
        $this->call(SummaryTableSeeder::class);
    }
}
