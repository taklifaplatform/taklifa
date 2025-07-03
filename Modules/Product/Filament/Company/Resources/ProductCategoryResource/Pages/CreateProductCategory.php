<?php

namespace Modules\Product\Filament\Company\Resources\ProductCategoryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Company\Entities\Company;
use Modules\Product\Filament\Company\Resources\ProductCategoryResource;

class CreateProductCategory extends CreateRecord
{
    protected static string $resource = ProductCategoryResource::class;
}