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
        Schema::create('notification_templates', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->json('settings_title')->nullable();
            $table->boolean('has_settings')->default(false);

            $table->string('order')->default(0);

            // icon will be media or user avatar
            $table->string('icon')->nullable();
            $table->boolean('icon_user_avatar')->default(false);
            $table->boolean('icon_rounded')->default(false);
            $table->string('icon_background_color')->nullable();

            $table->string('type')->unique();

            $table->boolean('sms_notification')->default(false);
            $table->json('sms_notification_title')->nullable();
            $table->json('sms_notification_description')->nullable();

            $table->boolean('push_notification')->default(false);
            $table->json('push_notification_title')->nullable();
            $table->json('push_notification_description')->nullable();

            $table->boolean('email_notification')->default(false);
            $table->json('email_notification_subject')->nullable();
            $table->json('email_notification_title')->nullable();
            $table->json('email_notification_description')->nullable();

            $table->boolean('db_notification')->default(true);
            $table->json('db_notification_title')->nullable();
            $table->json('db_notification_description')->nullable();

            $table->boolean('enabled')->default(true);

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
        Schema::dropIfExists('notification_templates');
    }
};
