<?php

use Illuminate\Database\Seeder;

class BouncerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::all();
        foreach ($users as $user) {
            \Bouncer::allow($user)->to('view-dashboard');
            \Bouncer::allow($user)->to('view-costumers');
            \Bouncer::allow($user)->to('view-products');
            \Bouncer::allow($user)->to('view-receiving');
            \Bouncer::allow($user)->to('view-shipment');
            \Bouncer::allow($user)->to('view-users');
            \Bouncer::allow($user)->to('view-logs');
        }
    }
}
