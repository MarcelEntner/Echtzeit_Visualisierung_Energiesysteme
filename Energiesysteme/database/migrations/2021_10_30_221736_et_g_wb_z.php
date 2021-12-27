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
            $table->id();
            $table->bigInteger('EnTech_id')->unsigned();
            $table->foreign('EnTech_id')->references('id')->on('EnTech')->onDelete('cascade');
            $table->double('Zaelerstand');
            $table->dateTime('TimeMeasured')->nullable();
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
        Schema::dropIfExists('EtGWbZ');
    }
}
