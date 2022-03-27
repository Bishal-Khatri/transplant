<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 50)->nullable();
            $table->string('name', 255);
            $table->longText('description')->nullable();
            $table->string('unit_size')->nullable();
            $table->string('main_image_original')->nullable();
            $table->string('main_image_large')->nullable();
            $table->string('main_image_medium')->nullable();
            $table->string('main_image_thumbnail')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->integer('has_variant')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable();
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
        Schema::dropIfExists('items');
    }
}
