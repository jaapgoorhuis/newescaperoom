<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('slider_items', function (Blueprint $table) {
            $table->string('caption_bottom', 10)->default('40px')->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('slider_items', function (Blueprint $table) {
            $table->dropColumn('caption_bottom');
        });
    }
};
