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
        Schema::create('companies', static function (Blueprint $blueprint): void {
            $blueprint->uuid('id')->primary();
            $blueprint->string('name');
            $blueprint->text('about')->nullable();
            $blueprint->foreignUuid('owner_id')->nullable()->constrained('users')->onDelete('SET NULL');

            $blueprint->string('verification_status')->default(
                \Modules\Company\Entities\Company::VERIFICATION_STATUS_PENDING
            );
            $blueprint->boolean('is_verified')->default(false);
            $blueprint->timestamp('verified_at')->nullable();
            $blueprint->foreignUuid('verified_by')->nullable()->constrained('users')->onDelete('SET NULL');

            $blueprint->foreignUuid('location_id')->nullable()->constrained('locations')->onDelete('SET NULL');

            $blueprint->boolean('is_enabled')->default(false);
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
