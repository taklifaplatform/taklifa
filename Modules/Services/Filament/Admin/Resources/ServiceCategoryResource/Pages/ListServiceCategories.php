<?php

namespace Modules\Services\Filament\Admin\Resources\ServiceCategoryResource\Pages;

use Modules\Services\Filament\Admin\Resources\ServiceCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceCategories extends ListRecords
{
    protected static string $resource = ServiceCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
