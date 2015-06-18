<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('email');
            $table->string('password', 60);
            $table->boolean('active')->default(false);
            $table->string('auth_provider')->default('eloquent');
            $table->string('auth_provider_id')->nullable();
            $table->string('activation_code', 100)->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            $table->unique('slug');
            $table->unique('email');
            $table->unique('auth_provider_id');
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
