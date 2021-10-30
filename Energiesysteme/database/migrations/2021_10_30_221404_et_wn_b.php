<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EtWnB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EtWnB', function (Blueprint $table) {
            $table->id();
            $table->double('Leistung');
            $table->double('Energie');
            $table->double('Vorlauftemp');
            $table->double('Ruecklauftemp');
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
        Schema::dropIfExists('EtWnB');
    }
}
