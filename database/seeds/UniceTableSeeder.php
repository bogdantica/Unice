<?php

use Illuminate\Database\Seeder;
use App\Models\Unice\Unice;

class UniceTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('Unices')->delete();

		// RinUnice
		Unice::create(array(
				'unice_name' => 'rin_unice',
				'unice_uid' => 'rin_unice_1234',
				'online' => false,
				'unice_type_id' => 100
			));
	}
}