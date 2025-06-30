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
        Schema::create('shipment_contract_cancel_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('contract_id')->references('id')->on('shipment_contracts')->cascadeOnDelete();
            $table->foreignUuid('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUuid('reason_id')->nullable()->references('id')->on('shipment_contract_cancel_reasons')->nullOnDelete();

            $table->text('message')->nullable();

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
        Schema::dropIfExists('shipment_contract_cancel_requests');
    }
};
