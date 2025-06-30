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
        Schema::create('prices', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->unsignedBigInteger('currency_id')->nullable()->index();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            // $table->foreignUuid('currency_id')->references('id')->on('currencies')->cascadeOnDelete();
            $table->integer('value')->default(0);
            $table->uuidMorphs('priceable');  // can be morphed to any Model

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
        Schema::dropIfExists('prices');
    }
};
