<?php

namespace Modules\Company\Filament\Admin\Resources\CompanyResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Modules\Company\Filament\Admin\Resources\CompanyResource;

class EditCompany extends EditRecord
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ViewAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return $this->getRecord()?->name ?? __('Edit Company');
    }
}
