<?php

namespace Modules\Geography\Filament\Admin\Resources\StateResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Geography\Filament\Admin\Exports\StateExporter;
use Modules\Geography\Filament\Admin\Imports\StateImporter;
use Modules\Geography\Filament\Admin\Resources\StateResource;

class ListStates extends ListRecords
{
    protected static string $resource = StateResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ImportAction::make('import_state')
                ->color('warning')
                ->label(__('Import States'))
                ->importer(StateImporter::class),
            Actions\ExportAction::make('export_state')
                ->color('success')
                ->label(__('Export States'))
                ->exporter(StateExporter::class),
        ];
    }
}
