<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Modules\Company\Entities\Company;
use Modules\Product\Entities\Product;
use Modules\Services\Entities\Service;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
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

                // stats for products
            Stat::make(__('Products'), Product::query()->count())
                ->icon('heroicon-s-cube')
                ->color('primary')
                ->description(__('Total number of new Products')),
        ];
    }
}
