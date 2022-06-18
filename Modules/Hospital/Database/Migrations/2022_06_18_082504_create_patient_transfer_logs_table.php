<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientTransferLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_transfer_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transferred_by_user')->comment('user_id');
            $table->unsignedBigInteger('transferred_by_hospital')->comment('hospital_id');
            $table->unsignedBigInteger('transferred_to_hospital')->comment('hospital_id');
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('patient_transfer_logs');
    }
}
