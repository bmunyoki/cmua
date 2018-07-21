<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyRecordingGsmV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        //Rename deaddt to readdt
        Schema::table('recording_gsm', function(Blueprint $table){
            $table->renameColumn('deaddt', 'readdt');
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
