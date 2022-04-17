<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->text('title', 255)->nullable();
            $table->integer('order');
            $table->string('type')->comment('slider,image,pdf,gallery,text,file_download');
            $table->json('slider_id')->nullable();
            $table->text('image_url')->nullable();
            $table->text('pdf_url')->nullable();
            $table->json('gallery_id')->nullable();
            $table->longText('text')->nullable();
            $table->json('file_download_urls')->nullable();
            $table->boolean('visibility')->default(1);
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
        Schema::dropIfExists('page_sections');
    }
}
