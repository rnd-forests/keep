<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('assignment_name');
            $table->string('slug');
            $table->softDeletes();
            $table->timestamps();

            $table->unique('slug');
        });
    }

    public function down()
    {
        Schema::drop('assignments');
    }
}
