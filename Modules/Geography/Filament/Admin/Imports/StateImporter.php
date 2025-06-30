<?php

namespace Modules\Geography\Filament\Admin\Imports;

use Modules\Geography\Entities\State;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class StateImporter extends Importer
{
    protected static ?string $model = State::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->label(__('Name')),
            ImportColumn::make('code')
                ->label(__('Code')),
        ];
    }

    public function resolveRecord(): ?State
    {
        if (isset($this->data['id']) && $this->data['id']) {
            return State::firstOrNew([
                'id' => $this->data['id'],
            ]);
        }

        return new State();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your State import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
