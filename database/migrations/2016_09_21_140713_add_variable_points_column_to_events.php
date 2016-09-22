<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVariablePointsColumnToEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::table('events', function ($table) {
           $table->boolean('variable_points')->default(0);
       });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
       Schema::table('events', function ($table) {
           $table->dropColumn('variable_points');
       });
     }
}
