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
        Schema::create('notification_drivers', function (Blueprint $blueprint) {
            $blueprint->uuid('id');

            $blueprint->uuidMorphs('notifable');

            $blueprint->string('driver');
            $blueprint->string('token');

            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_drivers');
    }
};
