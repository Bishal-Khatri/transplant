<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            // HLA
            $table->string('hla_a_m')->nullable();
            $table->string('hla_a_f')->nullable();
            $table->string('hla_b_m')->nullable();
            $table->string('hla_b_f')->nullable();
            $table->string('hla_dr_m')->nullable();
            $table->string('hla_dr_f')->nullable();

            // CDC
            $table->string('cdc_t_cell')->nullable();
            $table->string('cdc_B_cell')->nullable();

            // DSA
            $table->string('dsa_class_1')->nullable();
            $table->string('dsa_class_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {

        });
    }
}
