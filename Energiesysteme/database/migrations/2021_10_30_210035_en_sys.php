<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnSys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EnSys', function (Blueprint $table) {
            $table->id();
            $table->string('Bezeichnung');
            $table->string('Katastralgemeinden');
            $table->double('Postleitzahl');
            $table->double('AzErgeugungstechnologien')->nullable();;
            $table->double('AzVerbraucher')->nullable();;
            $table->double('AzSpeicher')->nullable();;
            $table->double('GesNennleistung')->nullable();;
            $table->double('GesEnergie')->nullable();;
            $table->double('GesVerbraucherLeistung')->nullable();;
            $table->double('GesVerbraucherEnergie')->nullable();;
            $table->double('GesSpeicherKap')->nullable();;
            $table->double('AktuellerNetzbezug')->nullable();;
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
        Schema::dropIfExists('EnSys');
    }
}
