<?php

use Modules\Geography\Entities\State;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Stichoza\GoogleTranslate\GoogleTranslate;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('states', function (Blueprint $table) {
            $table->jsonb('title')->nullable()->after('name');
        });

        $translator = new GoogleTranslate();
        $translator->setSource('en');
        $translator->setTarget('ar');

        $states = State::all();

        foreach ($states as $state) {
            try {
                if ($state->name) { // Check if name is not null
                    $translatedName = $translator->translate($state->name);
                    $state->update([
                        'title' => [
                            'en' => $state->name,
                            'ar' => $translatedName,
                        ]
                    ]);
                } else {
                    // Handle cases where name is null
                    $state->update([
                        'title' => null,
                    ]);
                }
            } catch (\Exception $e) {
                // Handle translation errors
                echo "Translation failed for: {$state->name}\n";
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('states', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }
};
