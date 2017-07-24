<?php

use App\Models\Unice\Device;
use Illuminate\Database\Seeder;

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

        // Living Temperature
        Device::create(array(
            'device_name' => 'living_temperature',
            'device_display' => 'Living Temperature',
            'device_uid' => 'living_temperature_1234',
            'unice_id' => 2,
            'device_type_id' => \App\Models\Unice\MapDeviceType::SENSOR
        ));


    }
}