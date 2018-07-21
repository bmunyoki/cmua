<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsersTableV4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        //Add field to tack if password has been changed.
        Schema::table('users', function(Blueprint $table){
            $table->smallInteger('password_changed')->default(0);
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
    }
}
