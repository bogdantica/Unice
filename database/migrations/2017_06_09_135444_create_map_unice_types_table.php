<?php

use Illuminate\Database\Migrations\Migration;

class CreateMapUniceTypesTable extends Migration
{

    public function up()
    {
//        Schema::create('map_unice_types', function (Blueprint $table) {
//            $table->increments('id');
//
//            $table->integer('unice_type_id')->unique()->unsigned();
//            $table->string('type_name')->unique();
//            $table->string('type_display');
//
//            $table->timestamps();
//            $table->softDeletes();
//        });
    }

    public function down()
    {
        Schema::dropIfExists('map_unice_types');
    }
}