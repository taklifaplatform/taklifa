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
        Schema::create('shipment_proposals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('shipment_id')->references('id')->on('shipments')->cascadeOnDelete();
            $table->foreignUuid('invitation_id')->nullable()->references('id')->on('shipment_invitations')->nullOnDelete();

            $table->foreignUuid('driver_id')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUuid('company_id')->nullable()->references('id')->on('companies')->cascadeOnDelete();

            $table->string('status')->default('pending')->nullable();

            $table->date('ship_date')->nullable();
            $table->time('ship_time')->nullable();

            $table->text('message')->nullable();
            $table->foreignUuid('cost_id')->nullable()->references('id')->on('prices')->nullOnDelete();
            $table->foreignUuid('fee_id')->nullable()->references('id')->on('prices')->nullOnDelete();
            $table->foreignUuid('channel_id')->nullable()->references('id')->on('chat_channels')->nullOnDelete();

            $table->boolean('locked')->default(false);

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
        Schema::dropIfExists('shipment_proposals');
    }
};
