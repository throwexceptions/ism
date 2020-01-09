<?php

use Illuminate\Database\Seeder;

class PreferenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Preference::truncate();
        $pref = new \App\Preference();
        $pref->name = 'so_textbox';
        $pref->status = 1;
        $pref->save();

        $pref = new \App\Preference();
        $pref->name = 'po_textbox';
        $pref->status = 1;
        $pref->save();

        $pref = new \App\Preference();
        $pref->name = 'so_auto';
        $pref->status = 1;
        $pref->save();

        $pref = new \App\Preference();
        $pref->name = 'po_auto';
        $pref->status = 1;
        $pref->save();
    }
}
