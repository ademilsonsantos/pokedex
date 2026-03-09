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
        Schema::create('abilities_pokemon', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('abilities_id');
            $table->unsignedBigInteger('pokemon_id');
            $table->foreign('abilities_id')->references('id')->on('abilities')->onDelete('cascade');
            $table->foreign('pokemon_id')->references('id')->on('pokemon')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abilities_pokemon');
    }
};
