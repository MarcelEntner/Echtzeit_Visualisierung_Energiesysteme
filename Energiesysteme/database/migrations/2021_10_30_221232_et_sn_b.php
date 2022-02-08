<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EtSnB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EtSnB', function (Blueprint $table) {
            $table->id('idEtSnbB');            
            $table->dateTime('timestamp')->nullable();            
            $table->double('power')->default(0);
            $table->double('energy')->default(0);
            $table->double('voltagePh1')->nullable();
            $table->double('voltagePh2')->nullable();
            $table->double('voltagePh3')->nullable();
            $table->double('currentPh1')->nullable();
            $table->double('currentPh2')->nullable();
            $table->double('currentPh3')->nullable();
            $table->double('activePowerPh1')->nullable();
            $table->double('activePowerPh2')->nullable();
            $table->double('activePowerPh3')->nullable();
            $table->double('reactivePowerPh1')->nullable();
            $table->double('reactivePowerPh2')->nullable();
            $table->double('reactivePowerPh3')->nullable();
            $table->double('apperentPowerPh1')->nullable();
            $table->double('apperentPowerPh2')->nullable();
            $table->double('apperentPowerPh3')->nullable();
            $table->double('powerFactorPh1')->nullable();
            $table->double('powerFactorPh2')->nullable();
            $table->double('powerFactorPh3')->nullable();
            $table->double('frequencyPh1')->nullable();
            $table->double('frequencyPh2')->nullable();
            $table->double('frequencyPh3')->nullable();
            $table->timestamps();
            $table->bigInteger('enTech_idEnTech')->unsigned(); //EnTech_id
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
        Schema::dropIfExists('EtSnB');
    }
}
