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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->enum('sex', ['male', 'female']);
            $table->integer('age');
            $table->enum('type', ['dog', 'cat']);
            $table->enum('size', ['small', 'medium', 'big']);
            $table->enum('state', ['adopted', 'in adoption']);

            // Foreign keys: relations
            $table->foreignId('godfather_id')->constrained(
                table: 'users'
            );
            $table->foreignId('partner_id')->constrained(
                table: 'users'
            );
            $table->foreignId('veterinary_id')->constrained(
                table: 'users'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
