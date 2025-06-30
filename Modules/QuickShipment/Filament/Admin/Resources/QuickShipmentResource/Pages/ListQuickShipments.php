<?php

namespace Modules\QuickShipment\Filament\Admin\Resources\QuickShipmentResource\Pages;

use Modules\QuickShipment\Filament\Admin\Resources\QuickShipmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuickShipments extends ListRecords
{
    protected static string $resource = QuickShipmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
