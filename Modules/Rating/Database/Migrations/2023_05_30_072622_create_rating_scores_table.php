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
        Schema::create('rating_scores', static function (Blueprint $blueprint): void {
            $blueprint->uuid('id')->primary();
            $blueprint->foreignUuid('rating_id')->nullable()->constrained('ratings')->onDelete('cascade');
            $blueprint->foreignUuid('rating_type_id')->nullable()->constrained('rating_types')->onDelete('cascade');
            $blueprint->float('score')->default(5);
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_scores');
    }
};
