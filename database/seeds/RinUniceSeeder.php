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
            'name' => 'Rin Unice',
            'uid' => 'rin_unice_1234',
            'online' => false,
        ));


        $light = \App\Models\Unice\Device::create(array(
            'name' => 'Bedroom Light',
            'unice_id' => $unice->id,
            'device_type' => \App\Models\Unice\MapDeviceType::DOUBLE
        ));

        \App\Models\Unice\DeviceState::create(array(
            'device_id' => $light->id,
            'state' => 0,
            'target' => 0,
        ));

        // Living Temperature
        $hvac = \App\Models\Unice\Device::create(array(
            'name' => 'Heating HVAC',
            'unice_id' => $unice->id,
            'device_type' => \App\Models\Unice\MapDeviceType::TRIPLE
        ));

        \App\Models\Unice\DeviceState::create(array(
            'device_id' => $hvac->id,
            'state' => 0,
            'target' => 0,
        ));


        $livingLight = \App\Models\Unice\Device::create(array(
            'name' => 'living_light',
            'unice_id' => $unice->id,
            'device_type' => \App\Models\Unice\MapDeviceType::PERCENTAGE
        ));

        \App\Models\Unice\DeviceState::create(array(
            'device_id' => $livingLight->id,
            'state' => 0,
            'target' => 0,
        ));


        $temp = \App\Models\Unice\Device::create(array(
            'name' => 'Temperature',
            'unice_id' => $unice->id,
            'device_type' => \App\Models\Unice\MapDeviceType::SENSOR
        ));

        \App\Models\Unice\DeviceState::create(array(
            'device_id' => $temp->id,
            'state' => 0,
            'target' => 0,
        ));
    }
}
