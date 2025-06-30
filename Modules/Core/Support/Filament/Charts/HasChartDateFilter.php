<?php

namespace Modules\Core\Support\Filament\Charts;

use Flowframe\Trend\Trend;

trait HasChartDateFilter
{
    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    // get filtered data
    public function getFilteredData(Trend $trend)
    {
        $activeFilter = $this->filter;

        if ($activeFilter === 'today') {
            return $trend->between(
                start: now()->startOfDay(),
                end: now()->endOfDay(),
            )
                ->perHour()
                ->count();
        }

        if ($activeFilter === 'week') {
            return $trend->between(
                start: now()->startOfWeek(),
                end: now()->endOfWeek(),
            )
                ->perDay()
                ->count();
        }

        if ($activeFilter === 'month') {
            return $trend->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
                ->perDay()
                ->count();
        }

        if ($activeFilter === 'year') {
            return $trend->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
                ->perMonth()
                ->count();
        }
    }
}
