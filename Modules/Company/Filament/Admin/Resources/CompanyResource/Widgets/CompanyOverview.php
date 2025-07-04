<?php

namespace Modules\Company\Filament\Admin\Resources\CompanyResource\Widgets;

use Modules\Company\Entities\Company;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\User;
use Modules\Services\Entities\Service;

class CompanyOverview extends BaseWidget
{
    use InteractsWithPageTable;

    protected static ?string $pollingInterval = null;

    protected static ?int $sort = 0;
    protected function getStats(): array
    {
        return [
            Stat::make(__('Companies'), Company::query()->count())
                ->icon('heroicon-s-building-office-2')
                ->color('primary')
                ->description(__('Total number of companies')),

            Stat::make(__('Users'), User::query()->count())
                ->icon('heroicon-s-user-group')
                ->color('primary')
                ->description(__('Total number of new user')),

            Stat::make(__('Services'), Service::query()->count())
                ->icon('heroicon-s-megaphone')
                ->color('primary')
                ->description(__('Total number of new Service')),
        ];
    }
}
