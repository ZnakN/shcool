<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('brands', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name_ru',1024)->nullable();
      $table->string('name_ua', 1024)->nullable();
      $table->string('url',1024)->nullable();
      $table->string('logo')->nullable();
      $table->text('text_ru')->nullable();
      $table->text('text_ua')->nullable();
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
        Schema::drop('brands');
    }
}
