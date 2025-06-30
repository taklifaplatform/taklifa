<?php

namespace Modules\Support\Filament\Admin\Resources\ReportReasonResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Support\Filament\Admin\Resources\ReportReasonResource;

class ListReportReasons extends ListRecords
{
    protected static string $resource = ReportReasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
