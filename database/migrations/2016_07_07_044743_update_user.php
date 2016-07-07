<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUser extends Migration
{
    /**
     * Run the migrations.
     * This migration adds chapter info for brothers into the Users table
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('ChapterClass')->default('Not Specified');
            $table->string('SchoolClass')->default('Not Specified');
            $table->boolean('ActiveStatus')->default(0);
            $table->integer('RankNumber')->default(-1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ChapterClass');
            $table->dropColumn('SchoolClass');
            $table->dropColumn('ActiveStatus');
            $table->dropColumn('RankNumber');
        });
    }
}
