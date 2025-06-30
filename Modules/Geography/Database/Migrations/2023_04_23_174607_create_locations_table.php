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
        Schema::create('locations', static function (Blueprint $blueprint): void {
            $blueprint->uuid('id')->primary();

            // creator_id
            $blueprint->foreignUuid('creator_id')->nullable()->references('id')->on('users')->onDelete('cascade');

            // can be morphed to any Model
            $blueprint->uuidMorphs('locationable');
            $blueprint->string('phone_number')->nullable();

            $blueprint->string('name')->nullable();

            $blueprint->string('address')->nullable();
            $blueprint->string('address_complement')->nullable();

            $blueprint->string('building_name')->nullable();
            $blueprint->string('floor_number')->nullable();
            $blueprint->string('house_number')->nullable();

            $blueprint->string('postcode')->nullable();
            $blueprint->string('latitude')->nullable();
            $blueprint->string('longitude')->nullable();

            $blueprint->text('notes')->nullable();

            $blueprint->boolean('is_primary')->default(false);

            $blueprint->unsignedBigInteger('country_id')->nullable()->index();
            $blueprint->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $blueprint->unsignedBigInteger('state_id')->nullable()->index();
            $blueprint->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $blueprint->unsignedBigInteger('city_id')->nullable()->index();
            $blueprint->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
