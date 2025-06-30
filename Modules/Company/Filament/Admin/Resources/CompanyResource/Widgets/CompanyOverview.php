<?php

namespace Modules\Company\Filament\Admin\Resources\CompanyResource\Widgets;

use Modules\Company\Entities\Company;
use Modules\Shipment\Entities\Shipment;
use Modules\Company\Entities\CompanyMember;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use App\Models\User;
use Modules\Announcements\Entities\Announcement;

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

            Stat::make(__('Announcements'), Announcement::query()->count())
                ->icon('heroicon-s-megaphone')
                ->color('primary')
                ->description(__('Total number of new announcement')),
        ];
    }
}
