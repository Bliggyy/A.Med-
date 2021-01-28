<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocprofileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docprofile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doc_id')->nullable();
            $table->foreign('doc_id')->references('id')->on('users');
            $table->string('doc_email')->unique();
            $table->foreign('doc_email')->references('email')->on('users');
            $table->string('lname');
            $table->string('fname');
            $table->string('specialization');
            $table->integer('age');
            $table->string('sex');
            $table->date('bdate');
            $table->string('pnumber');
            $table->string('clinicadd');
            
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
        Schema::dropIfExists('docprofile');
    }
}
