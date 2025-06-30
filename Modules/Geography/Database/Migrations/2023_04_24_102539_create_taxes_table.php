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
        Schema::create('taxes', static function (Blueprint $blueprint): void {
            $blueprint->id();
            $blueprint->string('name')->unique();
            $blueprint->jsonb('rates')->nullable();
            $blueprint->string('cca3', 5)->nullable();
            $blueprint->string('cca2', 3)->nullable();
            $blueprint->string('zone')->nullable();
            $blueprint->string('vat_id')->nullable();
            $blueprint->string('tax_type')->nullable();
            $blueprint->string('generic_label')->nullable();
            $blueprint->unsignedBigInteger('country_id')->nullable()->index();
            $blueprint->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
