<?php

namespace Modules\Support\Filament\Admin\Resources\SupportResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Support\Filament\Admin\Resources\SupportResource;

class ListSupports extends ListRecords
{
    protected static string $resource = SupportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
