<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnicesTable extends Migration
{

    public function up()
    {
        Schema::create('unices', function (Blueprint $table) {
            $table->increments('id');

            $table->string('unice_name');
            $table->string('unice_display');
            $table->string('unice_uid')->unique();
            $table->boolean('online')->default(false);

            $table->integer('unice_type_id')->unsigned()->index();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('unices');
    }
}