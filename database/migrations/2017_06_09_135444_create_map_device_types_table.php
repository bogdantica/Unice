<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMapDeviceTypesTable extends Migration {

	public function up()
	{
		Schema::create('map_device_types', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('device_type')->unique()->unsigned();
            $table->string('name');

            $table->softDeletes();
            $table->timestamps();
        });
	}

	public function down()
	{
        Schema::dropIfExists('map_device_types');
	}
}