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
            $table->string('transplant_type')->default('none');
            $table->integer('hospital_type')->default(0);
            $table->string('application_letter')->nullable();
            $table->string('human_resource')->nullable();
            $table->string('tools_list')->nullable();
            $table->string('administrative_document')->nullable();
            $table->string('sanchalan_swikriti')->nullable();
            $table->string('renewal_letter')->nullable();
            $table->string('pan')->nullable();
            $table->string('tax_clearance')->nullable();
            $table->string('company_registration')->nullable();
            $table->timestamp('approved_date')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->text('reject_message')->nullable();
            $table->string('approve_status')->default('unapproved');
//            $table->integer('verification_status')->default(0);
            $table->integer('document_verification_status')->default(0);
            $table->integer('physical_verification_status')->default(0);
            $table->boolean('status')->default(1)->comment('accibility status');
            $table->unsignedBigInteger('active_license_id')->nullable();
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
