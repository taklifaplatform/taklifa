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
        Schema::create('vehicle_capacity_dimensions', static function (Blueprint $blueprint): void {
            $blueprint->uuid('id')->primary();
            $blueprint->foreignUuid('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $blueprint->string('length')->nullable();
            $blueprint->string('width')->nullable();
            $blueprint->string('height')->nullable();
            $blueprint->string('unit')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_capacity_dimensions');
    }
};
