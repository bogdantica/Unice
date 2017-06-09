<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();

        // $this->call(UsersTableSeeder::class);

        $this->call('MapUniceTypeTableSeeder');
        $this->command->info('MapUniceType table seeded!');

        $this->call('MapDeviceTypeTableSeeder');
        $this->command->info('MapDeviceType table seeded!');

        $this->call('UniceTableSeeder');
        $this->command->info('Unice table seeded!');


        $this->call('DeviceTableSeeder');
        $this->command->info('Device table seeded!');


        $this->call('DeviceStateTableSeeder');
        $this->command->info('DeviceState table seeded!');
    }
}