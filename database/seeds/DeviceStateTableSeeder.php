<?php

use Illuminate\Database\Seeder;
use App\Models\Unice\DeviceState;

class DeviceStateTableSeeder extends Seeder
{

    public function run()
    {
        //DB::table('State_Devices')->delete();

        // RoomLightState
        DeviceState::create(array(
            'device_id' => 1,
            'state' => 0,
            'target' => false,
        ));
        // Temperature
        DeviceState::create(array(
            'device_id' => 2,
            'state' => 27,
            'target' => 0,
        ));
    }
}