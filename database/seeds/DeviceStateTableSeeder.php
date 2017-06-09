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
            'state_current' => false,
            'state_target' => false,
            'state_target_real' => false,
            'last_time_state_sended' => \Carbon\Carbon::now(),
            'last_time_state_reported' => \Carbon\Carbon::now(),
            'manual_control' => false
        ));
    }
}