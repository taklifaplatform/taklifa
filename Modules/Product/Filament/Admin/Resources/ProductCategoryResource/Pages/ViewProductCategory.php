<?php

namespace Modules\Product\Filament\Admin\Resources\ProductCategoryResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Modules\Company\Filament\Admin\Resources\CompanyResource;
use Modules\Product\Filament\Admin\Resources\ProductCategoryResource;

class ViewProductCategory extends ViewRecord
{
    protected static string $resource = ProductCategoryResource::class;


    public function getTitle(): string | Htmlable
    {
        return $this->getRecord()?->name ?? __('View Product Category');
    }


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
                                            ->label(__('Name')),
                                        Components\TextEntry::make('order')
                                            ->label(__('Order')),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('parent.name')
                                            ->label(__('Parent Category'))
                                            ->badge(),
                                        Components\TextEntry::make('company.name')
                                            ->label(__('Company'))
                                            ->visible(fn ($record) => $record->company)
                                            ->url(function ($record) {
                                                return CompanyResource::getUrl('view', ['record' => $record->company]);
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
