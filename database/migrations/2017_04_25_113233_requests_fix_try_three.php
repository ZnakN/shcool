<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequestsFixTryThree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('requests', function(Blueprint $table) {
         $table->integer('payed')->nullable();
         $table->integer('discount')->nullable();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests', function (Blueprint $table) {
        
             $table->dropColumn('payed');  
             $table->dropColumn('discount');  
             
        });
    }
}
