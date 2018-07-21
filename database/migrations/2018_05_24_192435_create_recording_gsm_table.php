<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordingGsmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recording_gsm', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('target_id')->unsigned();
            $table->foreign('target_id')->references('id')->on('targets')->onDelete('cascade');
            $table->timestamp('sentdt');
            $table->smallInteger('readstatus')->default(0);
            $table->timestamp('deaddt')->nullable();
            $table->string('recordingname');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recording_gsm');
    }
}
