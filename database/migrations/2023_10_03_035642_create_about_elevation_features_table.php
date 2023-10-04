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
        Schema::create('about_elevation_features', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('about_elevation_section_id')->nullable();
            $table->string('icon')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('year')->nullable();
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
        Schema::dropIfExists('about_elevation_features');
    }
};
