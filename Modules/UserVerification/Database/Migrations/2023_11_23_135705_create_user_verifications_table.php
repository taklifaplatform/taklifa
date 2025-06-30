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
        Schema::create('user_verifications', static function (Blueprint $blueprint): void {
            $blueprint->uuid('id')->primary();
            $blueprint->string('name')->nullable();
            $blueprint->date('birth_date')->nullable();
            $blueprint->string('driving_license_number')->nullable();
            $blueprint->foreignUuid('user_id')->constrained('users')->onDelete('cascade');
            $blueprint->foreignId('nationality_id')->nullable()->constrained('countries')->onDelete('SET NULL');

            $blueprint->string('verification_status')->default(
                \Modules\UserVerification\Entities\UserVerification::VERIFICATION_STATUS_PENDING
            );
            $blueprint->boolean('is_verified')->default(false);
            $blueprint->dateTime('verified_at')->nullable();
            $blueprint->foreignUuid('verified_by')->nullable()->constrained('users')->onDelete('SET NULL');

            $blueprint->foreignUuid('location_id')->nullable()->constrained('locations')->onDelete('SET NULL');

            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_verifications');
    }
};
