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
        Schema::create('working_hours', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // can be morphed to any Model
            $table->uuidMorphs('working_hourable');

            $table->boolean('monday')->default(true);
            $table->time('monday_start')->default('08:00');
            $table->time('monday_end')->default('17:00');

            $table->boolean('tuesday')->default(true);
            $table->time('tuesday_start')->default('08:00');
            $table->time('tuesday_end')->default('17:00');

            $table->boolean('wednesday')->default(true);
            $table->time('wednesday_start')->default('08:00');
            $table->time('wednesday_end')->default('17:00');

            $table->boolean('thursday')->default(true);
            $table->time('thursday_start')->default('08:00');
            $table->time('thursday_end')->default('17:00');

            $table->boolean('friday')->default(true);
            $table->time('friday_start')->default('08:00');
            $table->time('friday_end')->default('17:00');

            $table->boolean('saturday')->default(false);
            $table->time('saturday_start')->default('08:00');
            $table->time('saturday_end')->default('17:00');

            $table->boolean('sunday')->default(false);
            $table->time('sunday_start')->default('08:00');
            $table->time('sunday_end')->default('17:00');

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
        Schema::dropIfExists('working_hours');
    }
};
