<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('license_number')->nullable();
            $table->string('unique_key');
            $table->unsignedBigInteger('issued_by');
            $table->dateTime('issue_date');
            $table->dateTime('expiry_date');
            $table->unsignedBigInteger('licenseable_id')->comment('user_id');
            $table->string('licenseable_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licenses');
    }
}
