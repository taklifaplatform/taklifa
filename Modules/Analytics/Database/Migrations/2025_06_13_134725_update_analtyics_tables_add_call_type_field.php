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
        Schema::table('announcement_analytics', function (Blueprint $table) {
            $table->string('call_type')->default('phone');
        });

        Schema::table('user_analytics', function (Blueprint $table) {
            $table->string('call_type')->default('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announcement_analytics', function (Blueprint $table) {
            $table->dropColumn('call_type');
        });

        Schema::table('user_analytics', function (Blueprint $table) {
            $table->dropColumn('call_type');
        });
    }
};
