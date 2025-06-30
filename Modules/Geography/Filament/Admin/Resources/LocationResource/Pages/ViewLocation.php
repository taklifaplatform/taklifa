<?php

namespace Modules\Geography\Filament\Admin\Resources\LocationResource\Pages;

use Filament\Pages\Actions;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Dotswan\MapPicker\Infolists\MapEntry;
use Modules\Geography\Filament\Admin\Resources\LocationResource;

class ViewLocation extends ViewRecord
{
    protected static string $resource = LocationResource::class;

    public $location;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                MapEntry::make('location')
                    ->label(__(''))
                    ->extraStyles([
                        'min-height: 50vh',
                        'min-width: 150vh',
                        'border-radius: 50px'
                    ])
                    ->state(fn($record) => ['lat' => $record?->latitude, 'lng' => $record?->longitude])
                    ->showMarker()
                    ->markerColor("#22c55eff")
                    ->showFullscreenControl()
                    ->draggable(false)
                    ->zoom(15),
            ]);
    }
}
