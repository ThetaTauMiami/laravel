<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixingUnspecifiedIds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('images', function ($table) {
          $table->renameColumn('uploader', 'user_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('images', function ($table) {
          $table->renameColumn('user_id', 'uploader');
        });
    }
}
