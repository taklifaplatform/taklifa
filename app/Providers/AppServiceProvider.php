<?php

namespace App\Providers;

use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use BezhanSalleh\FilamentLanguageSwitch\LanguageSwitch;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(static function (LanguageSwitch $languageSwitch): void {
            $languageSwitch
                ->locales(['ar', 'en']);
        }); 

        if (env('FORCE_HTTPS', false)) {
            URL::forceScheme('https');
        }

        Table::configureUsing(function (Table $table) {
            $table->paginated([10, 25, 50]);
        });


        \Illuminate\Support\Facades\RateLimiter::for('medialibrary-pro-uploads', function (\Illuminate\Http\Request $request) {
            return [
                \Illuminate\Cache\RateLimiting\Limit::perMinute(10)->by($request->ip()),
            ];
        });
    }
}
