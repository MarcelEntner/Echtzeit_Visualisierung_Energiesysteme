<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EtBsZ extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('EtBsZ', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('EnTech_id')->unsigned();
            $table->foreign('EnTech_id')->references('id')->on('EnTech')->onDelete('cascade');
            $table->double('Leistung');
            $table->double('Energie');
            $table->double('SpannungL1');
            $table->double('SpannungL2');
            $table->double('SpannungL3');
            $table->double('StromstaerkeL1');
            $table->double('StromstaerkeL2');
            $table->double('StromstaerkeL3');
            $table->double('WirkleistungL1');
            $table->double('WirkleistungL2');
            $table->double('WirkleistungL3');
            $table->double('BlindleistungL1');
            $table->double('BlindleistungL2');
            $table->double('BlindleistungL3');
            $table->double('ScheinleistungL1');
            $table->double('ScheinleistungL2');
            $table->double('ScheinleistungL3');
            $table->double('LeistungsfaktorL1');
            $table->double('LeistungsfaktorL2');
            $table->double('LeistungsfaktorL3');
            $table->double('FreuqenzL1');
            $table->double('FreuqenzL2');
            $table->double('FreuqenzL3');
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
        Schema::dropIfExists('EtBsZ');
    }
}
