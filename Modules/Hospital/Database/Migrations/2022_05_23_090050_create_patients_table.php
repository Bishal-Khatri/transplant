<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->string('gender');
            $table->string('date_of_birth');
            $table->string('marital_status');
            $table->unsignedBigInteger('occupation_id');
            $table->unsignedBigInteger('religion_id');
            $table->unsignedBigInteger('education_level_id');
            $table->unsignedBigInteger('ethnic_group_id');
            $table->string('citizenship_number');
            $table->string('nationality');
            $table->string('passport_number');
            $table->string('father_name');
            $table->string('mother_name');
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
        Schema::dropIfExists('patients');
    }
}
