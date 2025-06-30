<?php

namespace Modules\Vehicle\Filament\Admin\Resources\VehicleResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Modules\Vehicle\Filament\Admin\Resources\VehicleResource;
use Modules\Vehicle\Filament\Admin\Resources\VehicleModelResource;

class ViewVehicle extends ViewRecord
{
    protected static string $resource = VehicleResource::class;

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
                Components\Section::make(__('Vehicle Information'))
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(4)
                                ->schema([
                                    Components\Group::make([
                                        Components\SpatieMediaLibraryImageEntry::make('image')
                                            ->collection('image')
                                            ->label(__('Logo Vehicle')),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('model.name')
                                            ->label(__('Vehicle Model'))
                                            ->size(TextEntrySize::Medium)
                                            ->visible(fn ($record) => $record->model)
                                            ->url(function ($record) {
                                                return VehicleModelResource::getUrl('view', ['record' => $record->model]);
                                            }),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('plate_number')
                                            ->label(__('Plate Number'))
                                            ->size(TextEntrySize::Medium),
                                        Components\TextEntry::make('vin_number')
                                            ->label(__('VIN Number'))
                                            ->size(TextEntrySize::Medium),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('year')
                                            ->label(__('Year'))
                                            ->size(TextEntrySize::Medium),
                                        Components\TextEntry::make('color')
                                            ->size(TextEntrySize::Medium)
                                            ->label(__('Color'))
                                    ]),
                                ]),

                        ])->from('lg'),
                    ]),
            ]);
    }
}
