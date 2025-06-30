<?php

namespace Modules\Services\Filament\Admin\Resources\ServiceResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Modules\Services\Filament\Admin\Resources\ServiceResource;

class ViewService extends ViewRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return $this->getRecord()?->title ?? __('View Service');
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make(__('Service Details'))
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(3)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('title')
                                            ->label(__('Title')),

                                        Components\SpatieMediaLibraryImageEntry::make('cover')
                                            ->label(__('Cover'))
                                            ->collection('cover')
                                            ->size(80)
                                            ->circular(),
                                    ]),

                                    Components\Group::make([
                                        Components\SpatieMediaLibraryImageEntry::make('images')
                                            ->label(__('Images'))
                                            ->collection('images')
                                            ->size(80)
                                            ->circular(),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('company.name')
                                            ->visible(fn($record) => $record->company)
                                            ->url(function ($record) {
                                                if (!$record->company_id) {
                                                    return null;
                                                }
                                            })
                                            ->label(__('Company')),

                                        Components\TextEntry::make('driver.username')
                                            ->visible(fn($record) => $record->driver)
                                            ->url(function ($record) {
                                                if (!$record->driver_id) {
                                                    return null;
                                                }
                                            })
                                            ->label(__('Driver')),
                                    ]),


                                ]),

                        ])->from('lg'),
                    ]),

                Components\Section::make(heading: (__('Description')))
                    ->schema([
                        Components\TextEntry::make('description')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),

            ]);
    }
}
