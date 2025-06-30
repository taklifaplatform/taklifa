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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('avatar_url')->nullable();

            $table->string('username');
            $table->string('name')->nullable();

            $table->text('about')->nullable();

            $table->string('phone_number')->unique();
            $table->timestamp('phone_number_verified_at')->nullable();

            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');

            $table->string('active_role_id')->nullable();
            $table->string('active_company_id')->nullable();

            $table->uuid('location_id')->nullable();

            $table->dateTime('latest_activity')->default(now());
            $table->enum('status', ['online', 'busy', 'offline'])->default('offline');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
