<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('trainings', function (Blueprint $table) {
        $table->string('name', 1050)->after('id')->nullable();
        $table->string('url', 2050)->after('description')->nullable();
        $table->dropColumn('meta_title_ru');
        $table->dropColumn('meta_description_ru');
        $table->dropColumn('meta_keywords_ru');
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
      Schema::table('lessons', function (Blueprint $table) {
      $table->dropColumn('name');
      $table->dropColumn('url');
      $table->dropColumn('meta_title');
      $table->dropColumn('meta_description');
      $table->dropColumn('meta_keywords');
    });
  }
}
