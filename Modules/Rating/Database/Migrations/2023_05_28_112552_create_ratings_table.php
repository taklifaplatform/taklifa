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
        Schema::create('ratings', static function (Blueprint $blueprint): void {
            $blueprint->uuid('id')->primary();
            $blueprint->uuidMorphs('rateable');
            $blueprint->float('score')->default(4.9);
            $blueprint->foreignUuid('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $blueprint->text('comment')->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
