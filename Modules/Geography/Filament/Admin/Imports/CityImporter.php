<?php

namespace Modules\Geography\Filament\Admin\Imports;

use Modules\Geography\Entities\City;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Models\Import;

class CityImporter extends Importer
{
    protected static ?string $model = City::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->label(__('Name')),
        ];
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your City import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
