<?php

namespace Modules\Product\Filament\Company\Resources\ProductResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Product\Filament\Company\Resources\ProductResource;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Preserve the original creator and company
        $data['created_by'] = $this->record->created_by;
        $data['company_id'] = $this->record->company_id;
        // Optionally, you can add any additional logic here
        return $data;
    }
}