<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStateDevicesTable extends Migration {

	public function up()
	{
		Schema::create('state_devices', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('device_id')->unsigned();
			$table->string('state_current')->index();
			$table->string('state_target')->nullable()->index();
			$table->string('state_target_real')->nullable()->index();

			$table->datetime('last_time_target_updated')->nullable();

			$table->boolean('manual_control')->index()->default(true);
		});
	}

	public function down()
	{
		Schema::drop('state_devices');
	}
}