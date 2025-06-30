<?php

use Illuminate\Support\Facades\Schema;
use Modules\Geography\Entities\Currency;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Stichoza\GoogleTranslate\GoogleTranslate;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('currencies', function (Blueprint $table) {
            $table->jsonb('title')->nullable()->after('name');
        });

        $translator = new GoogleTranslate();
        $translator->setSource('en');
        $translator->setTarget('ar');

        $currencies = Currency::all();

        foreach ($currencies as $currency) {
            try {
                $translatedName = $translator->translate($currency->name);
                $currency->update([
                    'title' => [
                        'en' => $currency->name,
                        'ar' => $translatedName,
                    ]
                ]);
            } catch (\Exception $e) {
                // Handle translation errors
                echo "Translation failed for: {$currency->name}\n";
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('currencies', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }
};
