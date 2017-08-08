<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();

        // $this->call(UsersTableSeeder::class);

        $this->call(MapUniceTypeTableSeeder::class);
        $this->command->info('MapUniceType table seeded!');

        $this->call(MapDeviceTypeTableSeeder::class);
        $this->command->info('MapDeviceType table seeded!');

        $this->call(BaseUniceSeeder::class);
        $this->command->info('Unice table seeded!');


        $this->call(RinUniceSeeder::class);
        $this->command->info('Device table seeded!');
    }
}