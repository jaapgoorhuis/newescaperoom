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
        Schema::create('reusable_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->longText('content')->nullable();
            $table->json('style')->nullable();
            $table->json('sliderItems')->nullable(); // voor slider blocks
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reusable_blocks');
    }
};
