<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//could delete this migration if you add it in the choirs migration

class CreateChoirsTableAddFamilyId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('choirs', function (Blueprint $table) { 
                       
            $table->string('family_id');
           
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('choirs', function(Blueprint $table) {
            $table->dropColumn('family_id');
        });

    }
}
