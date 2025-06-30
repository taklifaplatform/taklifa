<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Modules\Core\Support\Filament\Charts\HasChartDateFilter;

class SoloDriversPerDayChart extends LineChartWidget
{
    use HasChartDateFilter;

    public function getHeading(): string
    {
        return __('Solo Drivers Registered');
    }

    protected static ?int $sort = 2;

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
    
        $data = Trend::query(
            User::query()
                ->whereHas('roles', function ($query) {
                    $query->where('name', User::ROLE_SOLO_DRIVER);
                })
            )
            ->between(
                start: $startDate,
                end: now()
            )
            ->perDay()
            ->count();
    
        return [
            'datasets' => [
                [
                    'label' => __('Total number of new solo drivers'),
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#6366f1', // Using a indigo color to differentiate from other charts
                    'fill' => false,
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }
} 