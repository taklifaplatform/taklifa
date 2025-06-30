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
        Schema::create('chat_channel_members', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('channel_id')->constrained('chat_channels')->cascadeOnDelete();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('added_by_user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('channel_role')->default('channel_member');
            $table->string('status')->default('member');

            $table->boolean('notifications_muted')->default(false);
            $table->boolean('shadow_banned')->default(false);
            $table->boolean('banned')->default(false);

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
        Schema::dropIfExists('chat_channel_members');
    }
};
