<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequestsFixTryTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requests', function(Blueprint $table) {
        $table->string('lessons_to_visit', 2050)->nullable();  
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
        
             $table->dropColumn('lessons_to_visit');  
            
        });
    }
}
