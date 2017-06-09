<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDevicesTable extends Migration {

	public function up()
	{
		Schema::create('devices', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('device_name');
			$table->string('device_uid')->unique();
			$table->integer('unice_id')->unsigned()->index();
			$table->integer('device_type_id')->unsigned()->index();
		});
	}

	public function down()
	{
		Schema::drop('devices');
	}
}