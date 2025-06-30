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
        Schema::create('company_invitations', static function (Blueprint $blueprint): void {
            $blueprint->uuid('id')->primary();
            $blueprint->string('name');
            $blueprint->string('phone_number');
            $blueprint->string('email')->nullable();
            $blueprint->text('message')->nullable();

            $blueprint->string('role')->nullable();

            $blueprint->string('invitation_code')->nullable();

            $blueprint->boolean('is_sent')->default(false);
            $blueprint->boolean('is_rejected')->default(false);

            $blueprint->foreignUuid('company_id')->constrained('companies')->onDelete('cascade');
            $blueprint->foreignUuid('sender_id')->nullable()->constrained('users')->onDelete('cascade');

            $blueprint->timestamps();

            $blueprint->unique(['phone_number', 'company_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_invitations');
    }
};
