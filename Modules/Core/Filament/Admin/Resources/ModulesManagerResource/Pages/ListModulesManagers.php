<?php

namespace Modules\Core\Filament\Admin\Resources\ModulesManagerResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\Core\Filament\Admin\Resources\ModulesManagerResource;

class ListModulesManagers extends ListRecords
{
    protected static string $resource = ModulesManagerResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
