<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EtPv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EtPv', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('EnTech_id')->unsigned();
            $table->double('Leistung')->nullable();
            $table->double('Energie')->nullable();
            $table->double('SpannungL1')->nullable();
            $table->double('SpannungL2')->nullable();
            $table->double('SpannungL3')->nullable();
            $table->double('StromstaerkeL1')->nullable();
            $table->double('StromstaerkeL2')->nullable();
            $table->double('StromstaerkeL3')->nullable();
            $table->double('WirkleistungL1')->nullable();
            $table->double('WirkleistungL2')->nullable();
            $table->double('WirkleistungL3')->nullable();
            $table->double('BlindleistungL1')->nullable();
            $table->double('BlindleistungL2')->nullable();
            $table->double('BlindleistungL3')->nullable();
            $table->double('ScheinleistungL1')->nullable();
            $table->double('ScheinleistungL2')->nullable();
            $table->double('ScheinleistungL3')->nullable();
            $table->double('LeistungsfaktorL1')->nullable();
            $table->double('LeistungsfaktorL2')->nullable();
            $table->double('LeistungsfaktorL3')->nullable();
            $table->double('FreuqenzL1')->nullable();
            $table->double('FreuqenzL2')->nullable();
            $table->double('FreuqenzL3')->nullable();
            $table->dateTime('TimeMeasured')->nullable();
            $table->timestamps();
            $table->foreign('EnTech_id')->references('id')->on('EnTech')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('EtPv');
    }
}
