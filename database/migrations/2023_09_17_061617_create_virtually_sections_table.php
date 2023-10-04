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
        Schema::create('virtually_sections', function (Blueprint $table) {
            $table->id();
            $table->string('sort_title')->nullable();
            $table->string('title')->nullable();
            $table->string('bg_image')->nullable();
            $table->text('description')->nullable();
            $table->string('button_text')->nullable();
            $table->string('link')->nullable();
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
        Schema::dropIfExists('virtually_sections');
    }
};
