<?php

use App\Models\Unice\MapDeviceType;
use Illuminate\Database\Seeder;

class MapDeviceTypeTableSeeder extends Seeder {

	public function run()
	{
        MapDeviceType::create([
            'device_type_id' => MapDeviceType::DOUBLE,
            'type_name' => 'double',
				'type_display' => 'Double Position'
        ]);

        MapDeviceType::create([
            'device_type_id' => MapDeviceType::TRIPLE,
            'type_name' => 'triple',
            'type_display' => 'Triple'
        ]);

        MapDeviceType::create([
            'device_type_id' => MapDeviceType::QUADRUPLE,
            'type_name' => 'quadruple',
            'type_display' => 'Quadruple'
        ]);

        MapDeviceType::create([
            'device_type_id' => MapDeviceType::PERCENTAGE,
            'type_name' => 'percentage',
            'type_display' => 'Pencentage'
        ]);

        MapDeviceType::create([
            'device_type_id' => MapDeviceType::SENSOR,
            'type_name' => 'sensor',
            'type_display' => 'Sensor'
        ]);
    }
}