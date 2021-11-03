<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EnTech extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EnTech', function (Blueprint $table) {
            $table->id();
            $table->string('Typ');
            $table->string('Bezeichnung');
            $table->string('Ort');
            $table->double('Laengengrad');
            $table->double('Breitengrad');
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
        
        Schema::dropIfExists('EnTech');
        
    }
}