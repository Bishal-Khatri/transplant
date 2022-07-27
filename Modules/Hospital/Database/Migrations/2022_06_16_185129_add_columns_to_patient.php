<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToPatient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {

            $table->string('blood_group', 20)->nullable();
            $table->string('dialysis_start_date', 255)->nullable();
            $table->string('hal_tissue_type', 255)->nullable();
            $table->string('cross_match_cdc', 255)->nullable();
            $table->string('dsa_titre', 255)->nullable();
            $table->string('pra', 255)->nullable();
            $table->string('meld_score', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('', function (Blueprint $table) {

        });
    }
}
