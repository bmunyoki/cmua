<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCasesTableV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('cases', function (Blueprint $table){
            if (Schema::hasColumn('user_id', 'cases')){
                $table->dropColumn('user_id');
                $table->bigInteger('user_id')->unsigned()->after('phone');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }else{
                $table->bigInteger('user_id')->unsigned()->after('phone');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');   
            }
            
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
