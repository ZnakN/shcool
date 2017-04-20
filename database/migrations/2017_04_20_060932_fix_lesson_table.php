<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('lessons', function (Blueprint $table) {
        $table->string('url', 2050)->nullable();
        $table->string('image', 2050)->nullable();
        $table->integer('status')->nullable();
        $table->string('meta_title', 2050)->nullable();
        $table->text('meta_description')->nullable();
        $table->string('meta_keywords', 2050)->nullable();
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
       Schema::table('lessons', function (Blueprint $table) {
      $table->dropColumn('url');
      $table->dropColumn('image');
      $table->dropColumn('status');
      $table->dropColumn('meta_title');
      $table->dropColumn('meta_description');
      $table->dropColumn('meta_keywords');
    });
  }
}
