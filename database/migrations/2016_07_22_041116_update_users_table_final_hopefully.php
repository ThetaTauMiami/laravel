<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTableFinalHopefully extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
          $table->integer('RankNumber')->change();
          $table->renameColumn('RankNumber', 'roll_number');
          $table->renameColumn('ChapterClass', 'chapter_class');
          $table->renameColumn('SchoolClass', 'school_class');
          $table->renameColumn('ActiveStatus', 'is_active');
          $table->string('linkedin_token')->nullable()->change();
          $table->string('image_id')->nullable();
          $table->string('resume_filepath')->nullable();
          $table->string('phone_number', 10);
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
          $table->integer('RankNumber')->default(-1)->change();
          $table->renameColumn('roll_number', 'RankNumber');
          $table->renameColumn('chapter_class', 'ChapterClass');
          $table->renameColumn('school_class', 'SchoolClass');
          $table->renameColumn('is_active', 'ActiveStatus');
          $table->string('linkedin_token')->default('')->change();
          $table->dropColumn('image_id');
          $table->dropColumn('resume_filepath');
          $table->dropColumn('phone_number');
      });
    }
}
