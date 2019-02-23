<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //could add family_id here if you delete the choirs_table_add_family_id migration
        Schema::create('choirs', function (Blueprint $table) {      
            
            $table->increments('id')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->string('name');
            $table->boolean('is_static');
            $table->string('status')->default("open");
            $table->string('repeat');
            $table->string('note');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            Schema::enableForeignKeyConstraints();            
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('choirs');
        /*
        $table->dropForeign('choirs_user_id_foreign');
        $table->dropIndex('choirs_user_id_index');
        $table->dropColumn('user_id');

        $table->dropForeign('choirs_created_by_foreign');
        $table->dropIndex('choirs_created_by_index');
        $table->dropColumn('created_by');
        */

    }
}
