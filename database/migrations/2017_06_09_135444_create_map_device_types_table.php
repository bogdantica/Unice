<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMapDeviceTypesTable extends Migration {

	public function up()
	{
		Schema::create('map_device_types', function(Blueprint $table) {
			$table->increments('id');

            $table->integer('device_type_id')->unique()->unsigned();
            $table->string('type_name')->unique();
            $table->string('type_display');

            $table->softDeletes();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('map_device_types');
	}
}