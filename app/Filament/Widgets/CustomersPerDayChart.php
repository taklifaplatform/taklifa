<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Modules\Core\Support\Filament\Charts\HasChartDateFilter;

class CustomersPerDayChart extends LineChartWidget
{
    use HasChartDateFilter;

    public function getHeading(): string
    {
        return __('Customers Registered');
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
                    $query->where('name', 'customer');
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
                    'label' => __('Total number of new customers'),
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#10b981', // Using a green color to differentiate from users chart
                    'fill' => false,
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }
} 