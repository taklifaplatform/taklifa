<?php

namespace Modules\Product\Filament\Admin\Resources\ProductResource\Pages;

use Modules\Product\Filament\Admin\Resources\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
