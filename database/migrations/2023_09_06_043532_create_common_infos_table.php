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
        Schema::create('common_infos', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('banner')->nullable();
            $table->text('about_text')->nullable();
            $table->string('office_time')->nullable();
            $table->string('location')->nullable();
            $table->string('office_address_one')->nullable();
            $table->string('office_address_two')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('hotline_number')->nullable();
            $table->string('email')->nullable();  
            $table->string('alt_email')->nullable();
            $table->string('tour_link')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
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
        Schema::dropIfExists('common_infos');
    }
};
