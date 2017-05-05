<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDiscounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('discounts', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('training_id')->unsigned();
      $table->integer('value')->unsigned();
      $table->string('code',1024)->nullable();
      $table->integer('status')->nullable();
      $table->timestamps();
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
        Schema::dropIfExists('discounts');
  }
}
