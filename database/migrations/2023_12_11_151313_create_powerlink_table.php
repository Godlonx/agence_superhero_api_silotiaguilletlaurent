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
        Schema::create('powerlink', function (Blueprint $table) {
            $table->string('HeroId');
            $table->string('PowerId');
            $table->primary(['HeroId', 'PowerId']);
            $table->foreign('HeroId')->references('id')->on('hero')->onDelete('cascade');
            $table->foreign('PowerId')->references('id')->on('power')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('powerlink');
    }
};
