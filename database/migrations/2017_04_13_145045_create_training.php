<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTraining extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training', function (Blueprint $table) {
      $table->increments('id');
      $table->longText('description')->nullable();
      $table->date('begin_date')->nullable();
      $table->date('end_date')->nullable();
      $table->string('image',1024)->nullable();
      $table->integer('lektor_id')->nullable();
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
        Schema::dropIfExists('training');
    }
}
