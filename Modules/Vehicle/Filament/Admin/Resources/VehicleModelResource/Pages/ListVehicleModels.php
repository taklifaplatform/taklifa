<?php

namespace Modules\Vehicle\Filament\Admin\Resources\VehicleModelResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Vehicle\Filament\Admin\Resources\VehicleModelResource;

class ListVehicleModels extends ListRecords
{
    protected static string $resource = VehicleModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
