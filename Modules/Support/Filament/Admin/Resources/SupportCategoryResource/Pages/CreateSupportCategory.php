<?php

namespace Modules\Support\Filament\Admin\Resources\SupportCategoryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Support\Filament\Admin\Resources\SupportCategoryResource;

class CreateSupportCategory extends CreateRecord
{
    protected static string $resource = SupportCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
