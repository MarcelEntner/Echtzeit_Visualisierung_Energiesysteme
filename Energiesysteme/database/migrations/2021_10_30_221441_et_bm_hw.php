<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EtBmHw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EtBmHw', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('EnTech_id')->unsigned();
            $table->foreign('EnTech_id')->references('id')->on('EnTech')->onDelete('cascade');
            $table->double('Leistung')->default(0);
            $table->double('Energie')->default(0);
            $table->double('Vorlauftemp')->nullable();
            $table->double('Ruecklauftemp')->nullable();
            $table->dateTime('TimeMeasured')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('EtBmHw');
    }
}
