<?php

use Illuminate\Database\Seeder;

class BaseUniceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Unice\Unice::create([
            'name' => 'UniceBase',
            'uid' => \App\Models\Unice\Unice::BASE_UID,
            'online' => false,
            'is_base' => true
        ]);
    }
}
