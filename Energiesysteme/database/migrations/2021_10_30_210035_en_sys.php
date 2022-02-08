<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class Ensys extends Migration
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
            $table->string('designation');
            $table->double('longitude')->nullable();;
            $table->double('latitude')->nullable();;
            $table->string('localPart');
            $table->integer('postalCode');
            $table->timestamps();
            $table->bigInteger('users_idusers')->unsigned(); //user_id
            $table->foreign('users_idusers')->references('id')->on('users')->onDelete('cascade');
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
