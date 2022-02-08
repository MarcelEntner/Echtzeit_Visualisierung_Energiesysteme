<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EtGWbZ extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EtGWbZ', function (Blueprint $table) {
            $table->id('idEtGWbZ');
            $table->dateTime('timestamp')->nullable();
            $table->double('energy')->nullable();
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
        Schema::dropIfExists('EtGWbZ');
    }
}
