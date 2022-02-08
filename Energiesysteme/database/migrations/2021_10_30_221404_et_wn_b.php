<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EtWnB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EtWnB', function (Blueprint $table) {
            $table->id('idEtWnB');
            $table->dateTime('timestamp')->nullable();
            $table->double('power')->default(0);
            $table->double('energy')->default(0);
            $table->double('flowTemp')->nullable();
            $table->double('returnTemp')->nullable();
            $table->double('volumeFlow')->nullable();
            $table->double('volume')->nullable();
            $table->timestamps();
            $table->bigInteger('enTech_idEnTech')->unsigned();
            $table->foreign('enTech_idEnTech')->references('id')->on('EnTech')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('EtWnB');
    }
}
