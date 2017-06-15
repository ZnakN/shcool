<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIsStaticField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::table('trainings', function(Blueprint $table) {
      $table->integer('is_static')->after('type')->default(2)->change();
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
      $table->integer('is_static')->after('type')->nullable()->change();
    });
    }
}
