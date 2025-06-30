<?php

namespace Modules\Geography\Filament\Admin\Resources\TaxResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Geography\Filament\Admin\Resources\TaxResource;

class ListTaxes extends ListRecords
{
    protected static string $resource = TaxResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
