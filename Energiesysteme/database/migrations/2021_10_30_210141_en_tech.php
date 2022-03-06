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
            $table->string('type');
            $table->string('designation');
            $table->string('description');
            $table->string('location');
            $table->double('longitude');
            $table->double('latitude');
            $table->binary('picture')->nullable();
            $table->string('imgpath')->nullable();
            $table->double('capacity')->nullable();
            $table->bigInteger('enSys_idEnSys')->unsigned(); //ensys_id
            $table->bigInteger('enSys_users_idusers')->unsigned();  //user_id
            $table->timestamps();  
            $table->foreign('enSys_users_idusers')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('enSys_idEnSys')->references('id')->on('EnSys')->onDelete('cascade');
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
