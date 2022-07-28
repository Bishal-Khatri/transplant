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
            $table->unsignedBigInteger('hospital_id');

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
            $table->enum('transplant_type', ['kidney','liver'])->nullable();

            $table->string('blood_group', 20)->nullable();
            $table->string('dialysis_start_date', 255)->nullable();
            $table->string('hal_tissue_type', 255)->nullable();
            $table->string('cross_match_cdc', 255)->nullable();
            $table->string('dsa_titre', 255)->nullable();
            $table->string('pra', 255)->nullable();
            $table->string('meld_score', 255)->nullable();

            // HLA
            $table->string('hla_a_m')->nullable();
            $table->string('hla_a_f')->nullable();
            $table->string('hla_b_m')->nullable();
            $table->string('hla_b_f')->nullable();
            $table->string('hla_dr_m')->nullable();
            $table->string('hla_dr_f')->nullable();

            // patient
            $table->string('patient_hla_a')->nullable();
            $table->string('patient_hla_b')->nullable();
            $table->string('patient_hla_drb1')->nullable();

            // donor
            $table->string('donor_hla_a')->nullable();
            $table->string('donor_hla_b')->nullable();
            $table->string('donor_hla_drb1')->nullable();

            // CDC
            $table->string('cdc_t_cell')->nullable();
            $table->string('cdc_B_cell')->nullable();

            // DSA
            $table->string('dsa_class_1')->nullable();
            $table->string('dsa_class_2')->nullable();

            $table->integer('status')->default(1);
            $table->text('status_change_remark')->nullable();
            $table->text('transfer_remarks')->nullable();
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
