<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInternalTitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('trainings', function(Blueprint $table) {
      $table->string('internal_title',2024)->after('name')->nullable();
    });
  }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('trainings', function (Blueprint $table) {
      $table->dropColumn('internal_title');
    });
  }
}
