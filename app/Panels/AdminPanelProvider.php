<?php

namespace App\Panels;

use Filament\Panel;
use App\Filament\Dashboard;
use App\Filament\Widgets;
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
use Modules\Company\Filament\Admin\Resources\CompanyResource\Widgets\CompanyOverview;
use Modules\User\Filament\Admin\Resources\UserResource\Widgets\UserOverview;
use App\Filament\Widgets\UsersPerDayChart;
use App\Filament\Widgets\AnnouncementsPerDayChart;
use App\Filament\Widgets\CustomersPerDayChart;
use App\Filament\Widgets\SoloDriversPerDayChart;


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
                'primary' => Color::Yellow,
            ])
            ->login()
            ->passwordReset()
            ->pages([
                Dashboard::class,
            ])
            ->widgets([
                CompanyOverview::class,
                UsersPerDayChart::class,
                AnnouncementsPerDayChart::class,
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
                // DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->databaseNotifications(true)
            ->plugins([
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(['en', 'ar']),
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
            ])
            ->spa();

        return $this->preloadPanelModule($panel);
    }
}
