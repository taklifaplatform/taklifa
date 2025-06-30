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
        Schema::create('Service_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->text('name');

            $table->text('description')->nullable();

            $table->foreignUuid('parent_id')->nullable()->constrained('Service_categories')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Service_categories');
    }
};
