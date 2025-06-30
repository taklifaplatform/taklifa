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
        Schema::create('shipments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('code')->nullable(); // public shipment code
            $table->string('handshake_code')->nullable(); // private shipment code

            $table->uuid('active_contract_id')->nullable()->index();

            $table->foreignUuid('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUuid('from_location_id')->nullable()->references('id')->on('locations')->nullOnDelete();
            $table->foreignUuid('to_location_id')->nullable()->references('id')->on('locations')->nullOnDelete();

            $table->date('pick_date')->nullable();
            $table->time('pick_time')->nullable();
            $table->date('deliver_date')->nullable();
            $table->time('deliver_time')->nullable();
            $table->uuid('recipient_id')->nullable();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_phone')->nullable();

            $table->foreignUuid('min_budget_id')->nullable()->references('id')->on('prices')->nullOnDelete();
            $table->foreignUuid('max_budget_id')->nullable()->references('id')->on('prices')->nullOnDelete();

            /**
                'document',
                'box',
                'multiple_boxes',
                'other',
             */
            $table->string('items_type')->default('document')->nullable();

            /**
                'pending',
                'cancelled',
                'delivering',
                'delivered',
                'draft',
             */
            $table->string('status')->default('draft')->nullable();

            $table->foreignUuid('selected_driver_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->foreignUuid('selected_company_id')->nullable()->references('id')->on('companies')->nullOnDelete();

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
        Schema::dropIfExists('shipments');
    }
};
