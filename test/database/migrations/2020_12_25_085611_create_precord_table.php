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
            $table->string('p_email');
            $table->foreign('p_email')->references('email')->on('users');
            $table->string('blood_type');
            $table->string('last_visit');
            $table->string('major_illnesses');
            $table->string('allergies');
            $table->string('e_contact');
            $table->string('e_number');
            
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
