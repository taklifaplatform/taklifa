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
        Schema::table('announcements', function (Blueprint $table) {
            $table->json('metadata')->nullable();
        });

        Schema::table('announcement_categories', function (Blueprint $table) {
            $table->json('metadata_fields')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn('metadata');
        });

        Schema::table('announcement_categories', function (Blueprint $table) {
            $table->dropColumn('metadata_fields');
        });
    }
};
