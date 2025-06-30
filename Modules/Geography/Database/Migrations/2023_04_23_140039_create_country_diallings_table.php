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
        Schema::create('country_diallings', static function (Blueprint $blueprint): void {
            $blueprint->id();
            $blueprint->unsignedBigInteger('country_id')->nullable()->index();
            $blueprint->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $blueprint->string('prefix')->nullable();
            $blueprint->string('mask')->nullable();
            $blueprint->string('mask_char')->nullable();
            $blueprint->string('dial_code')->nullable();
            $blueprint->string('international_prefix', 10)->nullable();
            $blueprint->string('national_destination_code_lengths')->nullable();
            $blueprint->string('national_number_lengths')->nullable();
            $blueprint->string('national_prefix', 10)->nullable();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_diallings');
    }
};
