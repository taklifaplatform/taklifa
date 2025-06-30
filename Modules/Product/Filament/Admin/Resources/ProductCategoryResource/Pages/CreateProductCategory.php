<?php

namespace Modules\Product\Filament\Admin\Resources\ProductCategoryResource\Pages;

use Modules\Product\Filament\Admin\Resources\ProductCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProductCategory extends CreateRecord
{
    protected static string $resource = ProductCategoryResource::class;
}
