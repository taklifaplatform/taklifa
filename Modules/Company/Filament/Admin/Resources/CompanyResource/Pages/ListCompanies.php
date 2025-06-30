<?php

namespace Modules\Company\Filament\Admin\Resources\CompanyResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\Company\Filament\Admin\Resources\CompanyResource;

class ListCompanies extends ListRecords
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
