<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLektor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
        Schema::create('lektors', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name_surname',1024)->nullable();
      $table->longText('description', 2024)->nullable();
      $table->string('url',1024)->nullable();
      $table->string('image',1024)->nullable();
    
    
      
      $table->string('meta_title',1024)->nullable();
      $table->longText('meta_description',2048)->nullable();
      $table->string('meta_keywords',1024)->nullable();
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
        Schema::dropIfExists('lektor');
    }
}
