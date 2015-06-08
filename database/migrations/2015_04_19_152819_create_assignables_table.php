<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignablesTable extends Migration
{
    public function up()
    {
        Schema::create('assignables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('assignment_id')->unsigned();
            $table->integer('assignable_id')->unsigned();
            $table->string('assignable_type');
        });
    }

    public function down()
    {
        Schema::drop('assignables');
    }
}
