<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDevicesTable extends Migration {

	public function up()
	{
		Schema::create('devices', function(Blueprint $table) {
			$table->increments('id');

            $table->integer('unice_id')->unsigned()->index();

            $table->string('device_name');
            $table->string('device_display');
            $table->string('device_uid')->unique();
            $table->integer('device_type_id')->unsigned()->index();

            $table->timestamps();
            $table->softDeletes();
        });
	}

	public function down()
	{
		Schema::drop('devices');
	}
}