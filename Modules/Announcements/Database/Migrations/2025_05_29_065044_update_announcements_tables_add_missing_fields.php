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
        Schema::table('announcement_categories', function (Blueprint $table) {
            $table->boolean('enabled')->default(true);
            $table->integer('order')->default(0);
        });

        Schema::table('announcements', function (Blueprint $table) {
            $table->foreignUuid('sub_category_id')->nullable()->constrained('announcement_categories')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('announcement_categories', function (Blueprint $table) {
            $table->dropColumn('enabled');
            $table->dropColumn('order');
        });

        Schema::table('announcements', function (Blueprint $table) {
            $table->dropForeign(['sub_category_id']);
            $table->dropColumn('sub_category_id');
        });
    }
};
