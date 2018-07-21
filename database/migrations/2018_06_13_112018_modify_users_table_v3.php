<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsersTableV3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        //Modify username to email
        Schema::table('users', function(Blueprint $table){
            $table->renameColumn('username', 'email');
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
