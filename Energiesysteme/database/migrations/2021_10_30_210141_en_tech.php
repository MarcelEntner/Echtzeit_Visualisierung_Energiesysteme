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
            $table->bigInteger('ensys_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ensys_id')->references('id')->on('EnSys')->onDelete('cascade');
            $table->string('Typ');
            $table->string('Bezeichnung');
            $table->string('Beschreibung');
            $table->string('Ort');
            $table->double('Laengengrad');
            $table->double('Breitengrad');
            $table->binary('Bild')->nullable();
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
