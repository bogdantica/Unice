<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStateDevicesTable extends Migration {

	public function up()
	{
		Schema::create('state_devices', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('device_id')->unsigned();

            $table->string('state')->index();
            $table->string('target')->nullable()->index();

            $table->timestamps();
            $table->softDeletes();
        });
	}

	public function down()
	{
		Schema::drop('state_devices');
	}
}