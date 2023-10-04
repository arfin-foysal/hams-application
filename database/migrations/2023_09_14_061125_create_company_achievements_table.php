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
        Schema::create('company_achievements', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->string('title')->nullable();
            $table->integer('count_start')->nullable();
            $table->integer('count_end')->nullable();
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
        Schema::dropIfExists('company_achievements');
    }
};
