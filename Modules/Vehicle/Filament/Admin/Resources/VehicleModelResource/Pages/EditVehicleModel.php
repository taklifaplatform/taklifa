<?php

namespace Modules\Vehicle\Filament\Admin\Resources\VehicleModelResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Modules\Vehicle\Filament\Admin\Resources\VehicleModelResource;

class EditVehicleModel extends EditRecord
{
    protected static string $resource = VehicleModelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return $this->getRecord()?->name ?? 'Edit Vehicle Model';
    }
}

