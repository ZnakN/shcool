<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToTableBrands extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('brands', function (Blueprint $table) {
      $table->string('meta_title_ru', 2050)->nullable();
      $table->text('meta_description_ru')->nullable();
      $table->string('meta_keywords_ru', 2050)->nullable();
      $table->string('meta_title_ua', 2050)->nullable();
      $table->text('meta_description_ua')->nullable();
      $table->string('meta_keywords_ua', 2050)->nullable();
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
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn('meta_title_ru');
            $table->dropColumn('meta_description_ru');
            $table->dropColumn('meta_keywords_ru');
            $table->dropColumn('meta_title_ua');
            $table->dropColumn('meta_description_ua');
            $table->dropColumn('meta_keywords_ua');
    });
  }
}
