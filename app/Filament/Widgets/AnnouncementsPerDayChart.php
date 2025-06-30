<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Modules\Announcements\Entities\Announcement;
use Modules\Core\Support\Filament\Charts\HasChartDateFilter;


class AnnouncementsPerDayChart extends LineChartWidget
{
    use HasChartDateFilter;

    public function getHeading(): string
    {
        return __('Announcements Created');
    }

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '200px';

    public function getFilters(): ?array
    {
        return [
            'Today' => __('Today'),
            'Last week' => __('Last week'),
            'Last month' => __('Last month'),
            'This year' => __('This year'),
        ];
    }

    protected function getData(): array
    {
        $startDate = match ($this->filter) {
            'Today' => now()->startOfDay(),
            'Last week' => now()->subWeek(),
            'Last month' => now()->subMonth(),
            'This year' => now()->startOfYear(),
            default => now()->subDays(7),
        };
    
        $data = Trend::model(Announcement::class)
            ->between(
                start: $startDate,
                end: now()
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => __('Total number of new announcement'),
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#3b82f6',
                    'fill' => false,
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }
}