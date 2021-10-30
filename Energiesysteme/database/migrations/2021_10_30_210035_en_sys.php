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
            $table->double('AzErgeugungstechnologien');
            $table->double('AzVerbraucher');
            $table->double('AzSpeicher');
            $table->double('GesNennleistung');
            $table->double('GesEnergie');
            $table->double('GesVerbraucherLeistung');
            $table->double('GesVerbraucherEnergie');
            $table->double('GesSpeicherKap');
            $table->double('AktuellerNetzbezug');
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
