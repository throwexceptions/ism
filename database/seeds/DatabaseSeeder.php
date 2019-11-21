<?php

use App\Receivable;
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
        \App\Log::truncate();
        $this->call(UserTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(ReceivableTableSeeder::class);
        $this->call(BatchTableSeeder::class);
        $this->call(ShipmentTableSeeder::class);
    }
}
