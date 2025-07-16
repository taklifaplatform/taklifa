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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->text('description')->nullable();

            $table->foreignUuid('company_id')->constrained('companies')->onDelete('cascade');

            $table->foreignUuid('category_id')->nullable()->constrained('product_categories')->nullOnDelete();
            $table->foreignUuid('batch_product_id')->nullable()->constrained('batch_products')->onDelete('set null');

            $table->boolean('is_available')->default(true);
            $table->boolean('created_with_ai')->default(false);

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
        Schema::dropIfExists('products');
    }
};
