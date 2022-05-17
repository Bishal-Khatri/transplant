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
            $table->string('section_type')->comment('component, widget');
            $table->string('section_name')->comment('slider,image,pdf,gallery,text,file_download');
            $table->json('background')->nullable()->comment('type & image_url');
            $table->json('json_data')->nullable()->comment('eg: {"image_url": "http://localhost/image.jpg"}');
            $table->longText('text')->nullable();
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
