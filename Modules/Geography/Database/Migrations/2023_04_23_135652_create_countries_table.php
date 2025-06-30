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
        Schema::create('countries', static function (Blueprint $blueprint): void {
            $blueprint->id();
            $blueprint->jsonb('name');
            $blueprint->string('code', 5)->unique();
            $blueprint->string('wikidata_id')->nullable();
            $blueprint->jsonb('languages')->nullable();
            $blueprint->string('flag')->nullable();
            $blueprint->bigInteger('sort')->default(100);
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
