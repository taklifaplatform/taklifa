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
        Schema::create('shipment_contracts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('shipment_id')->references('id')->on('shipments')->cascadeOnDelete();
            $table->foreignUuid('proposal_id')->nullable()->references('id')->on('shipment_proposals')->nullOnDelete();

            $table->foreignUuid('driver_id')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUuid('company_id')->nullable()->references('id')->on('companies')->cascadeOnDelete();

            $table->foreignUuid('total_cost_id')->nullable()->references('id')->on('prices')->nullOnDelete();
            $table->foreignUuid('fee_id')->nullable()->references('id')->on('prices')->nullOnDelete();
            $table->foreignUuid('channel_id')->nullable()->references('id')->on('chat_channels')->nullOnDelete();

            $table->string('status')->default('started')->nullable();

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
        Schema::dropIfExists('shipment_contracts');
    }
};
