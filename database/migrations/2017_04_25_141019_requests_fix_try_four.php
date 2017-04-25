<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequestsFixTryFour extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requests', function(Blueprint $table) {
         $table->integer('payed')->default(2)->change();
         $table->integer('status')->default(1)->change();
         $table->string('promo', 2050)->nullable();  
         $table->string('way_to_pay', 2050)->nullable();  
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         $table->dropColumn('way_to_pay');  
         $table->dropColumn('promo');  
    }
}
