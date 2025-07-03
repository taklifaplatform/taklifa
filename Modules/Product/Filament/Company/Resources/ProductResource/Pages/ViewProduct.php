<?php

namespace Modules\Product\Filament\Company\Resources\ProductResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Modules\Company\Filament\Admin\Resources\CompanyResource;
use Modules\Product\Filament\Company\Resources\ProductResource;
use Modules\Product\Filament\Company\Resources\ProductCategoryResource;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    public function getTitle(): string|Htmlable
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
                                            ->label(__('Company')),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('category.name')
                                            ->label(__('Category'))
                                            ->visible(fn($record) => $record->category)
                                            ->url(function ($record) {
                                                return ProductCategoryResource::getUrl('view', ['record' => $record->category]);
                                            }),
                                    ]),
                                ]),

                        ])->from('lg'),
                    ]),


                Components\Section::make(__('Description'))
                    ->schema([
                        Components\TextEntry::make('description')
                            ->label(__('Description'))
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),
            ]);
    }
}