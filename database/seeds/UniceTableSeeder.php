<?php

use Illuminate\Database\Seeder;
use App\Models\Unice\Unice;

class UniceTableSeeder extends Seeder
{

    public function run()
    {
        Unice::create(array(
            'unice_name' => 'app_client',
            'unice_display' => 'Application Client',
            'unice_uid' => Unice::BASE_UID,
            'online' => false,
            'unice_type_id' => \App\Models\Unice\MapUniceType::UNICE_BASE,
        ));

        // RinUnice
        Unice::create(array(
            'unice_name' => 'rin_unice',
            'unice_display' => 'Rin Unice',
            'unice_uid' => 'rin_unice_1234',
            'online' => false,
            'unice_type_id' => \App\Models\Unice\MapUniceType::UNICE_DEVICE_1000,
        ));
    }
}