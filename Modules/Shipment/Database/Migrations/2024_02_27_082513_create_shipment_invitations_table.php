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
        Schema::create('shipment_invitations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('shipment_id')->references('id')->on('shipments')->cascadeOnDelete();

            $table->uuid('proposal_id')->nullable();
            $table->foreignUuid('driver_id')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUuid('company_id')->nullable()->references('id')->on('companies')->cascadeOnDelete();

            /**
                'pending',
                'sent',
                'accepted',
                'declined',
             */
            $table->string('status')->default('pending')->nullable();

            $table->boolean('notification_sent')->default(false);
            $table->boolean('is_read')->default(false);

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
        Schema::dropIfExists('shipment_invitations');
    }
};
