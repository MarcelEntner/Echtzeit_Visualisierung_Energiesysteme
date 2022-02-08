<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EtBs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EtBs', function (Blueprint $table) {
            $table->id('idEtBs');
            $table->dateTime('timestamp')->nullable();  
            $table->double('power')->default(0);
            $table->double('energy')->default(0);
            $table->double('storageCapacity')->default(0);            
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
        Schema::dropIfExists('EtBs');
    }
}
