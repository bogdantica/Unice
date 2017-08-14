<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnicesTable extends Migration
{

    public function up()
    {
        Schema::create('unices', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name');

            $table->string('uid')->unique();

            $table->boolean('online')->default(false);
            $table->string('connection_uid')->nullable();

            $table->boolean('is_base')->default(false);


            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('unices');
    }
}