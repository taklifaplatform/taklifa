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
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('device_identifier', 60);
            $table->foreignUuid('company_id')->constrained('companies')->onDelete('cascade');
            $table->integer('total_items')->default(0);
            $table->decimal('total_cost', 10, 2)->default(0.00);

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
        Schema::dropIfExists('carts');
    }
};
