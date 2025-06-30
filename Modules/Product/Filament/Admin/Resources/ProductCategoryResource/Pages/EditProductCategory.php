<?php

namespace Modules\Product\Filament\Admin\Resources\ProductCategoryResource\Pages;

use Modules\Product\Filament\Admin\Resources\ProductCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductCategory extends EditRecord
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
