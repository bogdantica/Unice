<?php

use Illuminate\Database\Seeder;

class DevicesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Device::create([
            'device_name' => 'Usa',
            'device_token' => 'usa'
        ]);
        \App\Models\Device::create([
            'device_name' => 'Geam',
            'device_token' => 'geam'
        ]);
    }
}
