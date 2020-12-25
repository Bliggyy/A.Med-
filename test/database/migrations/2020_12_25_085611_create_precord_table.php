<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precord', function (Blueprint $table) {
            $table->id();
            $table->string('p_email')->unique();
            $table->foreign('p_email')->references('p_email')->on('pprofile');
            $table->string('blood_type');
            $table->date('last_visit');
            $table->string('major_illnesses');
            $table->string('allergies');
            $table->string('e_contact');
            $table->string('e_number');
            $table->string('medication')->nullable();
            
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
        Schema::dropIfExists('precord');
    }
}
