<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->boolean('title_visibility')->default(1);
            $table->string('slug', 255);
            $table->string('cover_image_original', 255)->nullable();
            $table->string('cover_image_large', 255)->nullable();
            $table->string('cover_image_medium', 255)->nullable();
            $table->string('cover_image_thumbnail', 255)->nullable();
            $table->text('short_description')->nullable();
            $table->string('content_type')->comment('page,nav,footer');
            $table->string('redirect_link')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->unsignedBigInteger('created_by');
            $table->boolean('visibility')->default(0);
            $table->integer('total_visits')->default(0);
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
        Schema::dropIfExists('pages');
    }
}
