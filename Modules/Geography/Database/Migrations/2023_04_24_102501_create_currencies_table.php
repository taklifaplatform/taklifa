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
        Schema::create('currencies', static function (Blueprint $blueprint): void {
            $blueprint->id();
            $blueprint->string('name')->unique();
            $blueprint->string('iso_code')->unique();
            $blueprint->string('iso_number')->unique();
            $blueprint->jsonb('units')->nullable();
            $blueprint->jsonb('coins')->nullable();
            $blueprint->jsonb('banknotes')->nullable();
            $blueprint->timestamps();
        });

        Schema::create('currency_countries', static function (Blueprint $blueprint): void {
            $blueprint->unsignedBigInteger('country_id')->nullable()->index();
            $blueprint->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $blueprint->unsignedBigInteger('currency_id')->nullable()->index();
            $blueprint->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_countries');
        Schema::dropIfExists('currencies');
    }
};
