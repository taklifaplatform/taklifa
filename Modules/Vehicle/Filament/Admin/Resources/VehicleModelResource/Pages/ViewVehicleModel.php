<?php

namespace Modules\Vehicle\Filament\Admin\Resources\VehicleModelResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Modules\Vehicle\Filament\Admin\Resources\VehicleModelResource;

class ViewVehicleModel extends ViewRecord
{
    protected static string $resource = VehicleModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return $this->getRecord()?->name ?? 'View Vehicle Model';
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make(__('Vehicle Model Information'))
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(3)
                                ->schema([
                                    Components\Group::make([
                                        Components\SpatieMediaLibraryImageEntry::make('map_icon')
                                            ->collection('map_icon')
                                            ->label(__('Map Icon')),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('name')
                                            ->label(__('Name'))
                                            ->size(TextEntrySize::Medium)
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('map_icon_width')
                                            ->label(__('Map Icon Width'))
                                            ->size(TextEntrySize::Medium),
                                        Components\TextEntry::make('map_icon_height')
                                            ->label(__('Map Icon Height'))
                                            ->size(TextEntrySize::Medium),
                                    ]),

                                ]),

                        ])->from('lg'),
                    ]),

            ]);
    }
}
