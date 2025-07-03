<?php

namespace App\Panels;

use Filament\Panel;
use App\Filament\Dashboard;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Http\Middleware\Authenticate;
use Filament\SpatieLaravelTranslatablePlugin;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class CompanyPanelProvider extends BasePanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $panel
            ->readOnlyRelationManagersOnResourceViewPagesByDefault(false)
            ->maxContentWidth(MaxWidth::Full)
            ->sidebarCollapsibleOnDesktop()
            ->id('company')
            ->path('company')
            ->font('Poppins')
            ->authGuard('web')
            ->colors([
                'primary' => Color::Emerald,
            ])
            ->login()
            ->passwordReset()
            ->pages([
                Dashboard::class,
            ])
            ->widgets([
                \Modules\Product\Filament\Company\Widgets\ProductStatsOverview::class,
                \Modules\Product\Filament\Company\Widgets\ProductsChart::class,
                \Modules\Product\Filament\Company\Widgets\RecentProducts::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(['en', 'ar']),
            ]);

        return $this->preloadPanelModule($panel);
    }
}