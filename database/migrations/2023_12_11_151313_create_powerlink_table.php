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
        Schema::create('powerlinks', function (Blueprint $table) {
            $table->string('hero_id');
            $table->string('power_id');
            $table->primary(['hero_id', 'power_id']);
            $table->foreign('hero_id')->references('id')->on('heroes')->onDelete('cascade');
            $table->foreign('power_id')->references('id')->on('powers')->onDelete('cascade');
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
