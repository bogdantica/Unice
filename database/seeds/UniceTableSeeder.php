<?php

use Illuminate\Database\Seeder;
use App\Models\Unice\Unice;

class UniceTableSeeder extends Seeder
{

    public function run()
    {
        //DB::table('Unices')->delete();

        Unice::create(array(
            'unice_name' => 'app_client',
            'unice_display' => 'Application Client',
            'unice_uid' => 'application_client_12349876',
            'online' => false,
            'unice_type_id' => \App\Models\Unice\MapUniceType::UNICE_BASE,
        ));

        // RinUnice
        Unice::create(array(
            'unice_name' => 'rin_unice',
            'unice_display' => 'Rin Unice',
            'unice_uid' => 'rin_unice_1234',
            'last_sync' => \Carbon\Carbon::now()->addDay(-2),
            'online' => false,
            'unice_type_id' => \App\Models\Unice\MapUniceType::UNICE_DEVICE_1000,
        ));
    }
}