<?php

use Illuminate\Database\Seeder;
use App\Models\Unice\MapUniceType;

class MapUniceTypeTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('MapUniceTypes')->delete();

		// UniceDevice100
		MapUniceType::create(array(
				'unice_type_id' => 100,
				'type_name' => 'unice_device_100',
				'type_display' => 'Unice Device_100'
			));

		// UniceDevice200
		MapUniceType::create(array(
				'unice_type_id' => 200,
				'type_name' => 'unice_device_200',
				'type_display' => 'Unice Device 200'
			));
	}
}