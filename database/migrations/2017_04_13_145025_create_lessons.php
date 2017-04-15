<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
       Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 1024)->nullable();
            $table->longText('description')->nullable();
            $table->integer('training_id')->unsigned();
           
            $table->timestamps();
        });
        
           Schema::table('lessons', function(Blueprint $table) {
      $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade')->onUpdate('cascade');
   });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
