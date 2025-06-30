<?php

namespace Modules\Geography\Filament\Admin\Exports;

use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;
use Modules\Geography\Entities\City;

class CityExporter extends Exporter
{
    protected static ?string $model = City::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name')
                ->label(__('Name')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your city export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

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
