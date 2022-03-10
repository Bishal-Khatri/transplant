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
            $table->unsignedBigInteger('user_id');
            $table->string('payment_method')->comment('cod, khalti, esewa');
            $table->string('payment_status')->default(0)->comment('0->unpaid, 1->success, 2->fail');
            $table->integer('status')->default(0)->comment('0->draft, 1->success, 2->canceled, 3->fail');
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
