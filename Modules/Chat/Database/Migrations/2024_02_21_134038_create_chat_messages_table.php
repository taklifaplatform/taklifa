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
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('channel_id')->constrained('chat_channels')->cascadeOnDelete();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();

            $table->text('text')->nullable();

            $table->string('type')->default('text');

            $table->uuid('parent_id')->nullable();
            $table->uuid('quoted_message_id')->nullable();
            //mentioned_users

            // show_in_channel
            $table->boolean('show_in_channel')->default(false);

            $table->text('reaction_counts')->nullable();
            $table->text('reaction_scores')->nullable();

            $table->timestamps();
        });

        Schema::create('chat_message_mentioned_users', function (Blueprint $table) {
            $table->uuid('message_id');
            $table->uuid('user_id');

            $table->primary(['message_id', 'user_id']);

            $table->foreign('message_id')->references('id')->on('chat_messages')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_messages');
    }
};
