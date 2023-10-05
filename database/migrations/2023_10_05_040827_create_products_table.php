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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('home_product_section_id')->nullable();
            $table->bigInteger('client_id')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('image')->nullable();
            $table->string('sort_title')->nullable();
            $table->string('title')->nullable();
            $table->string('sort_description')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->longText('description')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->boolean('is_active')->default(1);
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
        Schema::dropIfExists('products');
    }
};
