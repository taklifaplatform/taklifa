<?php

namespace Modules\Support\Filament\Admin\Resources\ReportReasonResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Support\Filament\Admin\Resources\ReportReasonResource;

class CreateReportReason extends CreateRecord
{
    protected static string $resource = ReportReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //
        ];
    }
}
