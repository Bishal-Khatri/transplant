<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_orders', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->unsignedBigInteger('order_by')->comment('user_id');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->integer('order_status');
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
        Schema::dropIfExists('image_orders');
    }
}
