<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('shipment_id')->references('id')->on('shipments')->cascadeOnDelete();

            $table->text('notes')->nullable();
            $table->string('dim_unit')->default('cm');
            $table->float('dim_width')->nullable();
            $table->float('dim_height')->nullable();
            $table->float('dim_length')->nullable();
            $table->string('cap_unit')->default('kg');
            $table->float('cap_weight')->nullable();

            $table->string('content')->nullable();
            $table->json('content_value')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_items');
    }
};
