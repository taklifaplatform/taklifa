<?php

namespace Modules\Product\Filament\Company\Widgets;

use Filament\Widgets\LineChartWidget;
use Modules\Product\Entities\Product;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Modules\Core\Support\Filament\Charts\HasChartDateFilter;

class ProductsChart extends LineChartWidget
{
    use HasChartDateFilter;

    public function getHeading(): string
    {
        return __('Products Chart');
    }

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '200px';

    protected static ?string $pollingInterval = null;

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

        $companyId = auth()->user()->ownedCompany?->id;

        $data = Trend::query(
                Product::query()->where('company_id', $companyId)
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
                    'label' => __('Total number of new products'),
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'borderColor' => '#10B981',
                    'fill' => false,
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }
}