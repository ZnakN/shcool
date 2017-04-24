<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TimeAdressToTrainings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::table('trainings', function (Blueprint $table) {
          $table->time('time_from')->nullable(); // з
          $table->time('time_to')->nullable(); // до
          $table->string('adress_where', 2050)->nullable(); // місце проведення
          $table->string('adress', 2050)->nullable(); // адреса
          $table->float('full_price', 8, 2)->nullable();    // Вартість курсу
          $table->float('one_price', 8, 2)->nullable();    // стоимость занятия
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
      $table->dropColumn('time_from');
      $table->dropColumn('time_to');
      $table->dropColumn('adress_where');
      $table->dropColumn('adress');
      $table->dropColumn('full_price');
      $table->dropColumn('one_price');
    });
    }
}
