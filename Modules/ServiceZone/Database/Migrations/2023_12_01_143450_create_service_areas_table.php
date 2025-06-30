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
        Schema::create('service_areas', static function (Blueprint $blueprint): void {
            $blueprint->uuid('id')->primary();
            $blueprint->foreignUuid('service_zone_id')->constrained('service_zones')->onDelete('cascade');
            $blueprint->string('name');
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_areas');
    }
};
