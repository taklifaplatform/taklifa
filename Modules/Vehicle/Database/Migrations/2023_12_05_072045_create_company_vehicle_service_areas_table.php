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
        Schema::create('company_vehicle_service_areas', static function (Blueprint $blueprint): void {
            $blueprint->foreignUuid('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $blueprint->foreignUuid('service_area_id')->constrained('service_areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_vehicle_service_areas');
    }
};
