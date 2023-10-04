<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_about_sections', function (Blueprint $table) {
            $table->id();
            $table->string('featured_image')->nullable();
            $table->string('short_title')->nullable();
            $table->string('title')->nullable();
            $table->string('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->integer('start_count')->nullable();
            $table->integer('end_count')->nullable();
            $table->string('name')->nullable();
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
        Schema::dropIfExists('home_about_sections');
    }
};
