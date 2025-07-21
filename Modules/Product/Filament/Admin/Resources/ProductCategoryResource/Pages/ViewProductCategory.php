<?php

namespace Modules\Product\Filament\Admin\Resources\ProductCategoryResource\Pages;

use Filament\Actions;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Modules\Product\Filament\Admin\Resources\ProductCategoryResource;

class ViewProductCategory extends ViewRecord
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make(__('Product Category Details'))
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(2)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('name')
                                            ->formatStateUsing(function ($record) {
                                                return $record->name[app()->getLocale()] ?? $record->name['en'] ?? '';
                                            })
                                            ->label(__('Name')),
                                        Components\TextEntry::make('order')
                                            ->label(__('Order')),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('parent.name')
                                            ->formatStateUsing(function ($record) {
                                                return $record->parent?->name[app()->getLocale()] ?? $record->parent?->name['en'] ?? __('No parent category');
                                            })
                                            ->label(__('Parent Category')),
                                    ]),
                                ]),
                        ])->from('lg'),
                    ]),

                Components\Section::make(__('Sub Categories'))
                    ->schema([
                        Components\RepeatableEntry::make('children')
                            ->label(__(''))
                            ->schema([
                                Components\TextEntry::make('name')
                                    ->formatStateUsing(function ($record) {
                                        return $record->name[app()->getLocale()] ?? $record->name['en'] ?? '';
                                    })
                                    ->label(__('')),

                            ])
                            ->columns(2)
                            ->columnSpanFull()
                            ->contained(false)
                            ->grid(1)
                    ])
                    ->visible(fn($record) => $record->children->isNotEmpty())
                    ->collapsible(),

                Components\Section::make(__('Description'))
                    ->schema([
                        Components\TextEntry::make('description')
                            ->label(__(''))
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}
