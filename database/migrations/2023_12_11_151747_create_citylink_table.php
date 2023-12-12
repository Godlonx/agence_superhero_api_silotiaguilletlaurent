<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citylink', function (Blueprint $table) {
            $table->integer('CityId');
            $table->integer('HeroId');
            $table->primary(['CityId','HeroId']);
            $table->foreign('CityId')->references('id')->on('City')->onDelete('cascade');
            $table->foreign('HeroId')->references('id')->on('Hero')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citylink');
    }
};
