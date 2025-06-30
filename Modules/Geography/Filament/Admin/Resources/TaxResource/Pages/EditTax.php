<?php

namespace Modules\Geography\Filament\Admin\Resources\TaxResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Geography\Filament\Admin\Resources\TaxResource;

class EditTax extends EditRecord
{
    protected static string $resource = TaxResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
