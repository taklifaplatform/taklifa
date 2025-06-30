<?php

namespace Modules\Notification\Filament\Admin\Resources\NotificationTemplateResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Notification\Filament\Admin\Exports\NotificationTemplateExporter;
use Modules\Notification\Filament\Admin\Imports\NotificationTemplateImporter;
use Modules\Notification\Filament\Admin\Resources\NotificationTemplateResource;

class ListNotificationTemplates extends ListRecords
{
    protected static string $resource = NotificationTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\ImportAction::make('import_notification_templates')
                ->label(__('Import Notification Templates'))
                ->color('warning')
                ->importer(NotificationTemplateImporter::class),

            Actions\ExportAction::make('export_notification_templates')
                ->label(__('Export Notification Templates'))
                ->color('success')
                ->exporter(NotificationTemplateExporter::class)
        ];
    }
}
