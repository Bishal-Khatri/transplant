<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('hospital_name');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('municipality_id');
            $table->string('palika_name');
            $table->enum('transplant_type', ['kidney', 'liver']);
            $table->enum('hospital_type', ['government', 'private']);
            $table->string('application_letter')->nullable();
            $table->string('human_resource')->nullable();
            $table->text('tools_list')->nullable();
            $table->string('administrative_document')->nullable();
            $table->string('sanchalan_swikriti')->nullable();
            $table->string('renewal_letter')->nullable();
            $table->string('pan')->nullable();
            $table->string('tax_clearance')->nullable();
            $table->string('company_registration')->nullable();
            $table->enum('approve_status', ['unapproved', 'approved', 'rejected'])->default('unapproved');
            $table->timestamp('approved_date')->nullable();
            $table->string('approved_by')->nullable();
            $table->text('reject_message')->nullable();
            $table->enum('verification_status', ['none', 'document_verified', 'physical_verified', 'verified'])->default('none');
            $table->unsignedBigInteger('active_license_id')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('hospitals');
    }
}
