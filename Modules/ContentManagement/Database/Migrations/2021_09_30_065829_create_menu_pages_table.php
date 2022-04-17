<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_pages', function (Blueprint $table) {
            $table->id();
            $table->string('display_name');
            $table->string('type')->default('url')->comment('url, page, category');
            $table->text('slug')->nullable();
            $table->text('url')->nullable();
            $table->unsignedBigInteger('menu_id');
            $table->integer('order')->default(1);
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->string('alt_text',255)->nullable();
            $table->string('target',20)->nullable();
            $table->longText('custom_css')->nullable();
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
        Schema::dropIfExists('menu_pages');
    }
}
