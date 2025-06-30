<?php

namespace Modules\Services\Filament\Admin\Resources\ServiceCategoryResource\Pages;

use Modules\Services\Filament\Admin\Resources\ServiceCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceCategory extends EditRecord
{
    protected static string $resource = ServiceCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
