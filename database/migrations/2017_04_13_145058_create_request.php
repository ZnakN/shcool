<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('request', function (Blueprint $table) {
         
            $table->increments('id');
            $table->string('PIB', 1024)->nullable();
            $table->string('company_name', 1024)->nullable();
            $table->string('phone_number', 1024)->nullable();
            $table->string('E_mail', 1024)->nullable();
            $table->integer('training_id')->nullable();
            $table->integer('status')->nullable();
            $table->integer('lessons_to_visit')->nullable();
            $table->string('wishes', 2048)->nullable();
            $table->integer('present')->nullable();
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
        Schema::dropIfExists('request');
    }
}
