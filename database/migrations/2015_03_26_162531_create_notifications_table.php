<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sent_from', '25')->nullable();
            $table->string('type', 128)->nullable();
            $table->string('subject')->nullable();
            $table->string('slug')->unique();
            $table->text('body')->nullable();
            $table->integer('object_id')->unsigned();
            $table->string('object_type', 128);
            $table->dateTime('sent_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notifications');
    }
}
