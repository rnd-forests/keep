<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifiablesTable extends Migration
{
    public function up()
    {
        Schema::create('notifiables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notification_id')->unsigned();
            $table->morphs('notifiable');
        });
    }

    public function down()
    {
        Schema::drop('notifiables');
    }
}
