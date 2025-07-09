<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name')->nullable();

            $table->decimal('price', 10, 2);
            $table->string('price_currency')->default('SAR');

            $table->string('type')->default('count');
            $table->string('type_unit')->nullable();
            $table->decimal('type_value', 10, 2)->nullable();

            $table->integer('stock')->default(0);

            $table->foreignUuid('product_id')->constrained('products')->onDelete('cascade');

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
        Schema::dropIfExists('product_variants');
    }
};
