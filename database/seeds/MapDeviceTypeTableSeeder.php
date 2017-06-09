<?php

use Illuminate\Database\Seeder;
use App\Models\Unice\MapDeviceType;

class MapDeviceTypeTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('MapDeviceTypes')->delete();

		// DoublePosition
		MapDeviceType::create(array(
				'device_type_id' => 10,
				'type_name' => 'double_position',
				'type_display' => 'Double Position'
			));

		// Impulse
		MapDeviceType::create(array(
				'device_type_id' => 20,
				'type_name' => 'impulse',
				'type_display' => 'Impulse'
			));
	}
}