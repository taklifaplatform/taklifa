<?php

namespace App\Filament\Exports;

use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;
use Modules\UserVerification\Entities\UserVerification;

class UserVerificationExporter extends Exporter
{
    protected static ?string $model = UserVerification::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('user.name')->label(__('Name')),
            ExportColumn::make('user.phone_number')->label(__('Phone Number')),
            ExportColumn::make('user.email')->label(__('Email')),
            ExportColumn::make('user.verification.is_verified')->label(__('Is Verified')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your user verification export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
