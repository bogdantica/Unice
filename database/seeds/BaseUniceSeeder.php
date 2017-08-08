<?php

use Illuminate\Database\Seeder;

class BaseUniceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Unice\Unice::create(array(
            'unice_name' => 'app_client',
            'unice_display' => 'Application Client',
            'unice_uid' => \App\Models\Unice\Unice::BASE_UID,
            'online' => false,
            'unice_type_id' => \App\Models\Unice\MapUniceType::UNICE_BASE,
        ));
    }
}
