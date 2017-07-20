<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpecialEventsSetup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->text('fields')->nullable();
            $table->dateTime('reg_open');
            $table->dateTime('reg_close');
            $table->timestamps();
        });
        Schema::create('attendees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('special_event_id');
            $table->string('name');
            $table->string('email');
            $table->text('responses')->nullable();
            $table->text('comments');
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
        Schema::drop('special_events');
        Schema::drop('attendees');
    }
}
