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
        Schema::create('vehicle_information', static function (Blueprint $blueprint): void {
            $blueprint->uuid('id')->primary();
            $blueprint->foreignUuid('vehicle_id')->constrained('vehicles')->onDelete('cascade');
            $blueprint->string('body_type')->nullable();
            $blueprint->string('steering_wheel')->nullable();
            // 'right' or 'left
            $blueprint->integer('top_speed')->nullable();
            $blueprint->integer('doors_count')->nullable();
            $blueprint->integer('seats_count')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_information');
    }
};
