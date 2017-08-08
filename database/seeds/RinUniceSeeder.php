<?php

use Illuminate\Database\Seeder;

class RinUniceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unice = \App\Models\Unice\Unice::create(array(
            'unice_name' => 'rin_unice',
            'unice_display' => 'Rin Unice',
            'unice_uid' => 'rin_unice_1234',
            'online' => false,
            'unice_type_id' => \App\Models\Unice\MapUniceType::UNICE_DEVICE_1000,
        ));


        $light = \App\Models\Unice\Device::create(array(
            'device_name' => 'bedroom_light',
            'device_display' => 'Bedroom Light',
            'device_uid' => 'bedroom_light' . uniqid(),
            'unice_id' => $unice->id,
            'device_type_id' => \App\Models\Unice\MapDeviceType::DOUBLE
        ));

        \App\Models\Unice\DeviceState::create(array(
            'device_id' => $light->id,
            'state' => 0,
            'target' => 0,
        ));


        // Living Temperature
        $hvac = \App\Models\Unice\Device::create(array(
            'device_name' => 'bedroom_hvac',
            'device_display' => 'Heating HVAC',
            'device_uid' => 'bedroom_hvac' . uniqid(),
            'unice_id' => $unice->id,
            'device_type_id' => \App\Models\Unice\MapDeviceType::TRIPLE
        ));

        \App\Models\Unice\DeviceState::create(array(
            'device_id' => $hvac->id,
            'state' => 0,
            'target' => 0,
        ));


        $livingLight = \App\Models\Unice\Device::create(array(
            'device_name' => 'living_light',
            'device_display' => 'Living Light',
            'device_uid' => 'Living' . uniqid(),
            'unice_id' => $unice->id,
            'device_type_id' => \App\Models\Unice\MapDeviceType::PERCENTAGE
        ));

        \App\Models\Unice\DeviceState::create(array(
            'device_id' => $livingLight->id,
            'state' => 0,
            'target' => 0,
        ));


        $temp = \App\Models\Unice\Device::create(array(
            'device_name' => 'temperature',
            'device_display' => 'Temperature',
            'device_uid' => 'Temperature' . uniqid(),
            'unice_id' => $unice->id,
            'device_type_id' => \App\Models\Unice\MapDeviceType::SENSOR
        ));

        \App\Models\Unice\DeviceState::create(array(
            'device_id' => $temp->id,
            'state' => 0,
            'target' => 0,
        ));

        
    }
}
