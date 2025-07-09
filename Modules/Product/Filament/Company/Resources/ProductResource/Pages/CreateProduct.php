<?php

namespace Modules\Product\Filament\Company\Resources\ProductResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Product\Filament\Company\Resources\ProductResource;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        $data['company_id'] = auth()->user()->ownedCompany->id;
        return $data;
    }
}