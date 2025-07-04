<?php

namespace Modules\Product\Filament\Admin\Resources\ProductResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Modules\Product\Filament\Admin\Resources\ProductResource;
use Modules\Company\Filament\Admin\Resources\CompanyResource;
use Modules\Product\Filament\Admin\Resources\ProductCategoryResource;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    public function getTitle(): string | Htmlable
    {
        return $this->getRecord()?->name ?? __('View Product');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make(__('Product Details'))
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(2)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('name')
                                            ->label(__('Name')),
                                        Components\TextEntry::make('company.name')
                                            ->label(__('Company'))
                                            ->visible(fn ($record) => $record->company)
                                            ->url(function ($record) {
                                                return CompanyResource::getUrl('view', ['record' => $record->company]);
                                            }),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('category.name')
                                            ->label(__('Category'))
                                            ->visible(fn ($record) => $record->category)
                                            ->url(function ($record) {
                                                return ProductCategoryResource::getUrl('view', ['record' => $record->category]);
                                            }),
                                    ]),
                                ]),

                        ])->from('lg'),
                    ]),
            ]);
    }
}
