<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePprofileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pprofile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('p_id')->nullable();
            $table->foreign('p_id')->references('id')->on('users');
            $table->string('p_email')->unique();
            $table->string('lname');
            $table->string('fname');
            $table->integer('age');
            $table->string('sex');
            $table->date('bdate');
            $table->string('pnumber');
            
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
        Schema::dropIfExists('pprofile');
    }
}
