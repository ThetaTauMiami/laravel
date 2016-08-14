<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEventTableFinalHopefully extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('events', function (Blueprint $table) {
          $table->date('date')->default('');
          $table->string('location')->nullable();
          $table->integer('album_id')->nullable();
          $table->string('description')->nullable();
          $table->integer('image_id')->nullable();
          $table->integer('semester_id')->default(0);
          $table->boolean('is_public')->default(false);
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('events', function (Blueprint $table) {
          $table->dropColumn('date');
          $table->dropColumn('location');
          $table->dropColumn('album_id');
          $table->dropColumn('description');
          $table->dropColumn('image_id');
          $table->dropColumn('semester_id');
          $table->dropColumn('isPublic');
      });
    }
}
