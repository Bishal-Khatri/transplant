<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('unique_id')->default(0);
            $table->unsignedBigInteger('user_id')->comment('order_by');
            $table->string('payment_method')->comment('cod, khalti, esewa');
            $table->string('payment_status')->default(1)->comment('UNPAID = 1; SUCCESS = 2; FAILED = 3');
            $table->integer('status')->default(1)->comment('SUCCESS = 1; PROCESSING = 2; SHIPPED = 3; COMPLETED = 4;CANCELED = 5; FAILED = 6;');
            $table->integer('total_price')->default(0);
            $table->integer('shipping_price')->default(0);
            $table->integer('address_id')->nullable();
            $table->text('device_id')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
