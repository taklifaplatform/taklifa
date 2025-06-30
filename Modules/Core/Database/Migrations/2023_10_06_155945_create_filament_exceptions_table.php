<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('filament_exceptions_table', static function (Blueprint $blueprint): void {
            $blueprint->id();
            $blueprint->string('type', 255);
            $blueprint->string('code');
            $blueprint->longText('message', 255);
            $blueprint->string('file', 255);
            $blueprint->integer('line');
            $blueprint->text('trace');
            $blueprint->string('method');
            $blueprint->string('path', 255);
            $blueprint->text('query');
            $blueprint->text('body');
            $blueprint->text('cookies');
            $blueprint->text('headers');
            $blueprint->string('ip');
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::drop('filament_exceptions_table');
    }
};
