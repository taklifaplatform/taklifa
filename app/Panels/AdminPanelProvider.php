<?php

namespace App\Panels;

use Filament\Panel;
use Filament\Pages;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Http\Middleware\Authenticate;
use Filament\SpatieLaravelTranslatablePlugin;
use Illuminate\Session\Middleware\StartSession;
use App\Filament\Widgets\UsersPerDayChart;
use App\Filament\Widgets\ServicesPerDayChart;
use App\Filament\Widgets\CustomersPerDayChart;
use App\Filament\Widgets\SoloDriversPerDayChart;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Filament\Http\Middleware\DisableBladeIconComponents;
use BezhanSalleh\FilamentExceptions\FilamentExceptionsPlugin;
use Modules\Company\Filament\Admin\Resources\CompanyResource\Widgets\CompanyOverview;



class AdminPanelProvider extends BasePanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $panel
            ->readOnlyRelationManagersOnResourceViewPagesByDefault(false)
            ->default()
            ->maxContentWidth(MaxWidth::Full)
            ->sidebarCollapsibleOnDesktop()
            ->default()
            ->id('admin')
            ->path('admin')
            ->font('Poppins')
            ->authGuard('web')
            ->colors([
                'primary' => Color::Emerald,
            ])
            ->login()
            ->passwordReset()
            ->pages([
                Pages\Dashboard::class,
            ])
            ->widgets([
                CompanyOverview::class,
                UsersPerDayChart::class,
                ServicesPerDayChart::class,
                CustomersPerDayChart::class,
                SoloDriversPerDayChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(['en', 'ar']),
                    FilamentExceptionsPlugin::make(),
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
            ]);

        return $this->preloadPanelModule($panel);
    }
}
