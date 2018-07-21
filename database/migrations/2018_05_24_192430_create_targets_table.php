<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//use DB;

class CreateTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('deviceserial');
            $table->timestamp('authenticationTime')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('batterylevel')->nullable();
            $table->string('totalinternalspace')->nullable();
            $table->string('availableinternalspace')->nullable();
            $table->string('totalexternalspace')->nullable();
            $table->string('availableexternalspace')->nullable();
            $table->string('versionrelease')->nullable();
            $table->string('versionincremental')->nullable();
            $table->smallInteger('versionsdknumber')->nullable();
            $table->string('board')->nullable();
            $table->string('bootloader')->nullable();
            $table->string('brand')->nullable();
            $table->string('display')->nullable();
            $table->string('fingerprint')->nullable();
            $table->string('hardware')->nullable();
            $table->string('host')->nullable();
            $table->string('dID')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('product')->nullable();
            $table->string('tags')->nullable();
            $table->string('time')->nullable();
            $table->string('type')->nullable();
            $table->string('builduser')->nullable();
            $table->string('networkoperator')->nullable();
            $table->string('email')->nullable();
            $table->string('mobilenumber')->nullable();
            $table->string('status')->nullable();
            $table->string('dateadded')->useCurrent();
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
        Schema::dropIfExists('targets');
    }
}
