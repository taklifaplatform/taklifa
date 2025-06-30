<?php

namespace Modules\Support\Filament\Admin\Resources\FaqsResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Support\Filament\Admin\Resources\FaqsResource;

class EditFaqs extends EditRecord
{
    protected static string $resource = FaqsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
