<?php

namespace Modules\Product\Filament\Admin\Resources\ProductResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Modules\Product\Filament\Admin\Resources\ProductResource;
use Modules\Company\Filament\Admin\Resources\CompanyResource;

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
                            Components\Grid::make(3)
                                ->schema([
                                    Components\Group::make([
                                        Components\SpatieMediaLibraryImageEntry::make('images')
                                            ->label(__('Image'))
                                            ->collection('images')
                                            ->size(80),
                                    ]),
                                    Components\Group::make([
                                        Components\TextEntry::make('name')
                                            ->label(__('Name')),
                                        Components\TextEntry::make('company.name')
                                            ->label(__('Company'))
                                            ->visible(fn($record) => $record->company)
                                            ->url(function ($record) {
                                                return CompanyResource::getUrl('view', ['record' => $record->company]);
                                            }),
                                    ]),

                                    Components\Group::make([
                                        Components\IconEntry::make('is_available')
                                            ->label(__('Is Available'))
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->boolean()

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
