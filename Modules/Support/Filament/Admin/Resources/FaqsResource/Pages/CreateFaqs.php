<?php

namespace Modules\Support\Filament\Admin\Resources\FaqsResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Support\Filament\Admin\Resources\FaqsResource;

class CreateFaqs extends CreateRecord
{
    protected static string $resource = FaqsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
