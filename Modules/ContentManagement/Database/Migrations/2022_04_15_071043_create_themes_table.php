<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->unsignedBigInteger('homepage_id')->nullable();
            $table->text('logo',255)->nullable();
            $table->text('title',255)->nullable();
            $table->text('copyright', 500)->nullable();
            $table->longText('footer')->nullable();
            $table->boolean('is_active')->default(0);
            $table->unsignedBigInteger('nav_menu_id')->after('homepage_id')->nullable();
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
        Schema::dropIfExists('themes');
    }
}
