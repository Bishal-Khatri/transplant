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
            $table->string('name');
            $table->string('citizenship_number');
            $table->string('passport_number')->nullable();
            $table->string('image')->nullable();
            $table->string('gender')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('marital_status')->nullable();
            $table->unsignedBigInteger('occupation_id')->nullable();
            $table->unsignedBigInteger('religion_id')->nullable();
            $table->unsignedBigInteger('education_level_id')->nullable();
            $table->unsignedBigInteger('ethnic_group_id')->nullable();
            $table->string('nationality')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();

            $table->string('relative_name')->nullable();
            $table->string('relation_with_relative')->nullable();
            $table->string('contact_number_1')->nullable();
            $table->string('contact_number_2')->nullable();
            $table->string('email_address')->nullable();

            $table->unsignedBigInteger('permanent_province_id')->nullable();
            $table->unsignedBigInteger('permanent_district_id')->nullable();
            $table->unsignedBigInteger('permanent_municipality_id')->nullable();
            $table->string('permanent_ward')->nullable();
            $table->string('permanent_tole')->nullable();
            $table->unsignedBigInteger('current_province_id')->nullable();
            $table->unsignedBigInteger('current_district_id')->nullable();
            $table->unsignedBigInteger('current_municipality_id')->nullable();
            $table->string('current_ward')->nullable();
            $table->string('current_tole')->nullable();

            $table->string('hospital_bipanna_number')->nullable();
            $table->string('max_facilitatory_amount')->nullable();
            $table->string('referred_by')->nullable();
            $table->enum('transplant_type', ['kidney','liver'])->nullable();
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
