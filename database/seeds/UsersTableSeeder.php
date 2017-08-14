<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Bogdan TICA',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123')
        ]);
    }
}
