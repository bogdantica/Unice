<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMapDeviceTypesTable extends Migration {

	public function up()
	{
		Schema::create('map_device_types', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('device_type_id')->unique()->unsigned();
			$table->string('type_name')->unique();
			$table->string('type_display');
		});
	}

	public function down()
	{
		Schema::drop('map_device_types');
	}
}