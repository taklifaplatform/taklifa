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
        Schema::create('supports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->foreignUuid('category_id')->nullable()->references('id')->on('support_categories')->onDelete('SET NULL');

            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('subject')->required();
            $table->text('message')->required();
            $table->enum('status', ['pending', 'resolved'])->default('pending');

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
        Schema::dropIfExists('supports');
    }
};
