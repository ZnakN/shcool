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
         Schema::create('trainings', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name',1024)->nullable();
      $table->longText('description')->nullable();
      $table->string('url',1024)->nullable();
      $table->date('begin_date')->nullable();
      $table->date('end_date')->nullable();
      $table->string('image',1024)->nullable();
      
      $table->integer('lektor_id')->unsigned();
      $table->integer('status')->nullable();
      $table->mediumText('meta_title')->nullable();
      $table->mediumText('meta_description')->nullable();
      $table->mediumText('meta_keywords')->nullable();
      $table->timestamps();
        });
        
         Schema::table('trainings', function(Blueprint $table) {
       $table->foreign('lektor_id')->references('id')->on('lektors')->onDelete('cascade')->onUpdate('cascade');
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
