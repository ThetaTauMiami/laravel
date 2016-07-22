<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateImagesTableFinalHopefully extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('images', function (Blueprint $table) {
          $table->renameColumn('event_id', 'album_id');
          $table->string('thumbnail_path');
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
          $table->renameColumn('album_id', 'event_id');
          $table->dropColumn('thumbnail_path');
      });
    }
}
