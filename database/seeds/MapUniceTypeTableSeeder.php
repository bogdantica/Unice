<?php

use App\Models\Unice\MapUniceType;
use Illuminate\Database\Seeder;

class MapUniceTypeTableSeeder extends Seeder {

	public function run()
	{

        $types = collect([
            [
                'device_type' => MapUniceType::UNICE_BASE,
                'name' => 'Unice Base'
            ],
            [
                'device_type' => MapUniceType::UNICE_DEVICE_1000,
                'name' => 'Unice Device 1000'
            ],
            [
                'device_type' => MapUniceType::UNICE_DEVICE_2000,
                'name' => 'Unice Device 2000'
            ],
            [
                'device_type' => MapUniceType::UNICE_DEVICE_3000,
                'name' => 'Unice Device 3000'
            ]
        ]);

        $types->each(function ($type) {
            MapUniceType::create($type);
        });


		
		
	}
}