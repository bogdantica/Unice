<?php

use Illuminate\Database\Seeder;
use App\Models\Unice\Device;

class DeviceTableSeeder extends Seeder
{

    public function run()
    {
        //DB::table('Devices')->delete();

        // RoomLight
        Device::create(array(
            'device_name' => 'room_light',
            'device_display' => 'Room Light',
            'device_uid' => 'room_light_1234',
            'unice_id' => 2,
            'device_type_id' => \App\Models\Unice\MapDeviceType::DOUBLE_POSITION
        ));
    }
}