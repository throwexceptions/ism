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
        \App\Category::truncate();
        \App\Category::query()->insert([
            ['type' => 'SERVICES', 'name' => 'CCTV BGMPA'],
            ['type' => 'SERVICES', 'name' => 'FDAS'],
            ['type' => 'SERVICES', 'name' => 'STRUCTURED CABLING'],
            ['type' => 'SERVICES', 'name' => 'COMPUTERS'],
            ['type' => 'SERVICES', 'name' => 'ACCESSORIES'],
            ['type' => 'SERVICES', 'name' => 'DOOR ACCESS'],
        ]);

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
