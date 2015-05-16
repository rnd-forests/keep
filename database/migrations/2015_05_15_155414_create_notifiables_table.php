<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifiablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifiables', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('notification_id')->unsigned();
            $table->integer('notifiable_id')->unsigned();
            $table->string('notifiable_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notifiables');
	}

}
