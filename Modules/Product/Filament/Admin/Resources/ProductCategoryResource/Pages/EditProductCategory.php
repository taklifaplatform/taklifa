<?php

namespace Modules\Product\Filament\Admin\Resources\ProductCategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Product\Filament\Admin\Resources\ProductCategoryResource;

class EditProductCategory extends EditRecord
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
