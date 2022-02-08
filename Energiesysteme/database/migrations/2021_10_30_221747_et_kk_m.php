<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EtKkM extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EtKkM', function (Blueprint $table) {
            $table->id('idEtKkM');
            $table->dateTime('timestamp')->nullable();
            $table->double('power')->default(0);
            $table->double('energy')->default(0);
            $table->double('flowTemp')->nullable();
            $table->double('returnTemp')->nullable();
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
        Schema::dropIfExists('EtkkM');
    }
}
