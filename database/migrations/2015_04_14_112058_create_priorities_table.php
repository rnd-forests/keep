<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrioritiesTable extends Migration
{
    public function up()
    {
        Schema::create('priorities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->smallInteger('value')->unsigned();
            $table->text('description');
            $table->timestamps();

            $table->index('name');
        });
    }

    public function down()
    {
        Schema::drop('priorities');
    }
}
