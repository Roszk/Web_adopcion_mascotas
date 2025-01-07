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
        Schema::create('happy_endings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('story');
            $table->geography('location', subtype: 'point', srid: 4326);

            $table->foreignId('pet_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('happy_endings');
    }
};
