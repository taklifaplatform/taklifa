<?php

namespace Modules\Support\Filament\Admin\Resources\SupportCategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Support\Filament\Admin\Resources\SupportCategoryResource;

class ListSupportCategories extends ListRecords
{
    protected static string $resource = SupportCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
