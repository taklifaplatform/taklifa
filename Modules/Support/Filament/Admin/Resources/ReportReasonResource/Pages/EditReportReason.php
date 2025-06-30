<?php

namespace Modules\Support\Filament\Admin\Resources\ReportReasonResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Support\Filament\Admin\Resources\ReportReasonResource;

class EditReportReason extends EditRecord
{
    protected static string $resource = ReportReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
