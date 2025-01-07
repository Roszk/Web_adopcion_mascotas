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
        Schema::table('pets', function (Blueprint $table) {
            $table->string('image');
        });

        Schema::table('happy_endings', function (Blueprint $table) {
            // 'img1.jpg,img2.jpg,img3.jpg'
            $table->string('images');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->dropColumn(['image']);
        });

        Schema::table('happy_endings', function (Blueprint $table) {
            $table->dropColumn(['images']);
        });
    }
};
