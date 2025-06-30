<?php

namespace Modules\Geography\Filament\Admin\Resources\CountryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Geography\Filament\Admin\Resources\CountryResource;

class CreateCountries extends CreateRecord
{
    protected static string $resource = CountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
