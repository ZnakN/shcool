<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequestsFix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::table('requests', function (Blueprint $table) {
          $table->string('sphere', 2050)->nullable();
          $table->dropColumn('lessons_to_visit');   
           
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
        
           //  $table->dropColumn('lessons_to_visit');  
             $table->dropColumn('sphere');  
        });
          
    }
}
