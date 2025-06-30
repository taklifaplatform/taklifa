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
        Schema::create('vehicles', static function (Blueprint $blueprint): void {
            $blueprint->uuid('id')->primary();
            $blueprint->uuidMorphs('ownable');
            $blueprint->foreignUuid('model_id')->nullable()->constrained('vehicle_models')->onDelete('cascade');

            $blueprint->string('internal_id')->nullable();
            $blueprint->string('color')->nullable();
            $blueprint->string('plate_number')->nullable();
            $blueprint->string('vin_number')->nullable();
            $blueprint->integer('year')->nullable();
            $blueprint->timestamps();
        });

        Schema::create('company_vehicle_drivers', static function (Blueprint $blueprint): void {
            $blueprint->foreignUuid('driver_id')->constrained('users')->onDelete('cascade');
            $blueprint->foreignUuid('vehicle_id')->constrained('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
        Schema::dropIfExists('company_vehicle_drivers');
    }
};
