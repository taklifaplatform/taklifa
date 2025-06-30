<?php

namespace Modules\Support\Filament\Admin\Resources\SupportCategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Support\Filament\Admin\Resources\SupportCategoryResource;

class EditSupportCategory extends EditRecord
{
    protected static string $resource = SupportCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
