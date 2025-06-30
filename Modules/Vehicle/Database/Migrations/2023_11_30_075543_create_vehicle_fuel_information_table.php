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
        Schema::create('vehicle_fuel_information', static function (Blueprint $blueprint): void {
            $blueprint->uuid('id')->primary();
            $blueprint->foreignUuid('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $blueprint->string('fuel_type')->nullable();
            $blueprint->float('fuel_capacity')->nullable();
            $blueprint->float('liter_per_km_in_city')->nullable();
            $blueprint->float('liter_per_km_in_highway')->nullable();
            $blueprint->float('liter_per_km_mixed')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_fuel_information');
    }
};
