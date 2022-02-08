<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EtWs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EtWs', function (Blueprint $table) {
            $table->id('idEtWs');
            $table->dateTime('timestamp')->nullable();
            $table->double('power')->default(0);
            $table->double('energy')->default(0);
            $table->double('storageTempTop')->default(0);
            $table->double('storageTempMiddle')->default(0);
            $table->double('storageTempBottom')->default(0);
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
        Schema::dropIfExists('EtWs');
    }
}
