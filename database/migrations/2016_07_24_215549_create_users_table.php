<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone', 10);
            $table->string('password');
            $table->rememberToken();
            $table->integer('image_id')->nullable();
            $table->string('resume_path')->unique()->nullable();
            $table->string('chapter_class');
            $table->integer('roll_number');
            $table->string('school_class');
            $table->string('linkedin_token')->nullable();
            $table->boolean('active_status')->default(1);
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
        Schema::drop('users');
    }
}
