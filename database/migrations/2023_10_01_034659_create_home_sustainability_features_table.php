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
        Schema::create('home_sustainability_features', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('home_sustainability_id')->nullable();
            $table->string('title')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->string('count')->nullable();
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
        Schema::dropIfExists('home_sustainability_features');
    }
};
