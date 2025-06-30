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
        Schema::create('states', static function (Blueprint $blueprint): void {
            $blueprint->id();
            $blueprint->unsignedBigInteger('country_id')->nullable()->index();
            $blueprint->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $blueprint->string('name')->nullable();
            $blueprint->string('code');
            $blueprint->string('postal')->nullable();
            // TODO add geojson
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
