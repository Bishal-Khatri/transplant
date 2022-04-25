<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        ["OS"] = System.getProperty("os.version") ?: ""
//        ["API_LEVEL"] = android.os.Build.VERSION.SDK_INT
//        ["BRAND"] = android.os.Build.BRAND
//        ["DEVICE"] = android.os.Build.DEVICE
//        ["MODEL"] = android.os.Build.MODEL
//        ["PRODUCT"] = android.os.Build.PRODUCT
//        ["VERSION_CODE"] = BuildConfig.VERSION_CODE
//        ["VERSION_NAME"] = BuildConfig.VERSION_NAME
        Schema::table('users', function (Blueprint $table) {
            $table->string('os', 255)->nullable();
            $table->string('api_level',50)->nullable();
            $table->string('brand', 100)->nullable();
            $table->text('device')->nullable()->comment('firebase device token');
            $table->string('model', 255)->nullable();
            $table->string('product', 100)->nullable();
            $table->string('version_code', 100)->nullable();
            $table->string('version_name', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
