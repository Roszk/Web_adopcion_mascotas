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
        Schema::table('events', function (Blueprint $table) {
            $table->string('location')->change();
        });

        Schema::table('happy_endings', function (Blueprint $table) {
            $table->string('location')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->geography('location', subtype: 'point', srid: 4326);
        });

        Schema::table('happy_endings', function (Blueprint $table) {
            $table->geography('location', subtype: 'point', srid: 4326);
        });
    }
};
