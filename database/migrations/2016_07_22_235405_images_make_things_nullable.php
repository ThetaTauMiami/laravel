<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImagesMakeThingsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('images', function (Blueprint $table) {
          $table->string('thumbnail_path')->nullable()->change();
          $table->string('description')->nullable()->change();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('images', function (Blueprint $table) {
          $table->string('thumbnail_path')->change();
          $table->string('description')->change();
      });
    }
}
