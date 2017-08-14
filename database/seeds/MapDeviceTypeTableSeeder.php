<?php

use App\Models\Unice\MapDeviceType;
use Illuminate\Database\Seeder;

class MapDeviceTypeTableSeeder extends Seeder {

	public function run()
	{
        $devices = collect([
            [
                'device_type' => MapDeviceType::DOUBLE,
                'name' => 'Double'
            ],
            [
                'device_type' => MapDeviceType::TRIPLE,
                'name' => 'Triple'
            ],
            [
                'device_type' => MapDeviceType::QUADRUPLE,
                'name' => 'Quadruple'
            ],
            [
                'device_type' => MapDeviceType::PERCENTAGE,
                'name' => 'Percentage'
            ],
            [
                'device_type' => MapDeviceType::SENSOR,
                'name' => 'Sensor'
            ]
        ]);

        $devices->each(function ($device) {
            MapDeviceType::create($device);
        });

    }
}