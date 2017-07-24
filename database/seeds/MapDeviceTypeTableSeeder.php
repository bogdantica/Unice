<?php

use App\Models\Unice\MapDeviceType;
use Illuminate\Database\Seeder;

class MapDeviceTypeTableSeeder extends Seeder {

	public function run()
	{
		// DoublePosition
		MapDeviceType::create(array(
            'device_type_id' => MapDeviceType::DOUBLE_POSITION,
				'type_name' => 'double_position',
				'type_display' => 'Double Position'
			));

		// Impulse
		MapDeviceType::create(array(
            'device_type_id' => MapDeviceType::IMPULSE,
				'type_name' => 'impulse',
				'type_display' => 'Impulse'
			));
        // Sensor
        MapDeviceType::create([
            'device_type_id' => MapDeviceType::SENSOR,
            'type_name' => 'sensor',
            'type_display' => 'Sensor'
        ]);
	}
}