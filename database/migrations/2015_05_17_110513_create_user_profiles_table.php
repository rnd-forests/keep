<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('user_id');
            $table->text('location')->nullable();
            $table->text('bio')->nullable();
            $table->string('company')->nullable();
            $table->string('website')->nullable();
            $table->string('phone', 11)->nullable();
            $table->string('twitter_username')->nullable();
            $table->string('github_username')->nullable();
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
		Schema::drop('profiles');
	}

}
