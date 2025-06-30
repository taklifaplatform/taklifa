<?php

namespace Modules\Geography\Filament\Admin\Resources\CityResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Geography\Filament\Admin\Exports\CityExporter;
use Modules\Geography\Filament\Admin\Imports\CityImporter;
use Modules\Geography\Filament\Admin\Resources\CityResource;

class ListCities extends ListRecords
{
    protected static string $resource = CityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ImportAction::make('import_cities')
                ->color('warning')
                ->label(__('Import Cities'))
                ->importer(CityImporter::class),
            Actions\ExportAction::make('export_cities')
                ->color('success')
                ->label(__('Export Cities'))
                ->exporter(CityExporter::class),
        ];
    }
}
