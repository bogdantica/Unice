<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);

        $this->call(MapDeviceTypeTableSeeder::class);
        $this->command->info('MapDeviceType table seeded!');

        $this->call(BaseUniceSeeder::class);
        $this->command->info('Basic Unice created!');

        $this->call(RinUniceSeeder::class);
        $this->command->info('Rin Unice created!');
    }
}