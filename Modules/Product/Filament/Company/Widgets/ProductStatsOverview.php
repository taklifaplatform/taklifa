<?php

namespace Modules\Product\Filament\Company\Widgets;

use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Entities\ProductVariant;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ProductStatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        return [
            Stat::make(__('Product Categories'), ProductCategory::query()->count())
                ->icon('heroicon-s-archive-box')
                ->color('primary')
                ->description(__('Total number of product categories')),

            Stat::make(__('Products'), Product::query()->count())
                ->icon('heroicon-s-cube')
                ->color('success')
                ->description(__('Total number of products')),

            Stat::make(__('Product Variants'), ProductVariant::query()->count())
                ->icon('heroicon-s-squares-2x2')
                ->color('info')
                ->description(__('Total number of product variants')),
        ];
    }
}