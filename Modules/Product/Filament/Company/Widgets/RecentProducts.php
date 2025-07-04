<?php

namespace Modules\Product\Filament\Company\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Modules\Product\Entities\Product;
use Filament\Widgets\TableWidget as BaseWidget;
use Modules\Product\Filament\Company\Resources\ProductResource;

class RecentProducts extends BaseWidget
{
    protected static ?int $sort = 2;

    protected static ?string $pollingInterval = null;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name')),
                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('Category'))
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('variants_count')
                    ->label(__('Variants'))
                    ->counts('variants')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created'))
                    ->dateTime()
                    ->sortable()
                    ->since(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label(__('View'))
                    ->url(fn(Product $record): string => ProductResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-m-eye'),
            ])
            ->paginated([5, 10, 25]);
    }

    public function getTableHeading(): string
    {
        return __('Recent Products');
    }
}