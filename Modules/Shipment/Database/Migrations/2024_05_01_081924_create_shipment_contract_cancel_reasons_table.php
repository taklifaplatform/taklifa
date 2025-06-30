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
        Schema::create('shipment_contract_cancel_reasons', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->longText('title');
            $table->integer('order')->default(0);

            $table->boolean('for_customer')->default(true);

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
        Schema::dropIfExists('shipment_contract_cancel_reasons');
    }
};
