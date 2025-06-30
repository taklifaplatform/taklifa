<?php

namespace Modules\Support\Filament\Admin\Resources\FaqsResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Support\Filament\Admin\Resources\FaqsResource;

class ListFaqs extends ListRecords
{
    protected static string $resource = FaqsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
