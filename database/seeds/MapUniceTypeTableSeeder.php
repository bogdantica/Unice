<?php

use App\Models\Unice\MapUniceType;
use Illuminate\Database\Seeder;

class MapUniceTypeTableSeeder extends Seeder {

	public function run()
	{
        MapUniceType::create(array(
            'unice_type_id' => MapUniceType::UNICE_BASE,
            'type_name' => 'unice_base',
            'type_display' => 'Unice Base'
        ));

		// UniceDevice100
		MapUniceType::create(array(
				'unice_type_id' => MapUniceType::UNICE_DEVICE_1000,
				'type_name' => 'unice_device_1000',
				'type_display' => 'Unice Device 1000'
			));

		// UniceDevice200
		MapUniceType::create(array(
				'unice_type_id' => MapUniceType::UNICE_DEVICE_2000,
				'type_name' => 'unice_device_2000',
				'type_display' => 'Unice Device 2000'
			));
	}
}