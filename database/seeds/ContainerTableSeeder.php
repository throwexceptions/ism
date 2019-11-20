<?php

use Illuminate\Database\Seeder;

class ContainerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Container::truncate();
        for ($x = 0; $x <= 500; $x++) {
            $faker               = Faker\Factory::create();

            $container               = new \App\Container();
            $container->supplier_id  = \App\Supplier::all()->random(2)[0]->id;
            $container->container_no = $faker->randomNumber();
            $container->date_arrival = $faker->dateTimeBetween($startDate = '-5 days', $endDate='+ 2 days');
            $container->remarks      = $faker->sentence();
            $container->created_by   = \App\User::all()->random(2)[0]->id;
            $container->save();

            $log = new \App\Log();
            $log->user_id = \App\User::all()->random(2)[0]->id;
            $log->remarks = $container->id.' add container';
            $log->save();
        }
    }
}
