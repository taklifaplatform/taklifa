<?php

namespace Modules\Geography\Filament\Admin\Exports;

use Modules\Geography\Entities\State;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;

class StateExporter extends Exporter
{
    protected static ?string $model = State::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name')
                ->label(__('Name')),
            ExportColumn::make('code')
                ->label(__('Code')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your state export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    public function getJobConnection(): ?string
    {
        return env('EXPORT_QUEUE_CONNECTION', 'sync');
    }
}
