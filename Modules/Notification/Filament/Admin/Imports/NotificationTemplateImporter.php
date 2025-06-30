<?php

namespace Modules\Notification\Filament\Admin\Imports;

use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Models\Import;
use Modules\Notification\Entities\NotificationTemplate;

class NotificationTemplateImporter extends Importer
{
    protected static ?string $model = NotificationTemplate::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('id')
                ->label(__('ID')),
            ImportColumn::make('type')
                ->label(__('Type')),
            ImportColumn::make('icon')
                ->label(__('Icon')),
            ImportColumn::make('icon_user_avatar')
                ->label(__('Icon User Avatar')),
            ImportColumn::make('icon_rounded')
                ->label(__('Icon Rounded')),
            ImportColumn::make('icon_background_color')
                ->label(__('Icon Background Color')),
            ImportColumn::make('sms_notification')
                ->label(__('SMS Notification')),
            ImportColumn::make('sms_notification_title')
                ->label(__('SMS Notification Title')),
            ImportColumn::make('sms_notification_description')
                ->label(__('SMS Notification Description')),
            ImportColumn::make('push_notification')
                ->label(__('Push Notification')),
            ImportColumn::make('push_notification_title')
                ->label(__('Push Notification Title')),
            ImportColumn::make('push_notification_description')
                ->label(__('Push Notification Description')),
            ImportColumn::make('email_notification')
                ->label(__('Email Notification')),
            ImportColumn::make('email_notification_subject')
                ->label(__('Email Notification Subject')),
            ImportColumn::make('email_notification_title')
                ->label(__('Email Notification Title')),
            ImportColumn::make('email_notification_description')
                ->label(__('Email Notification Description')),
            ImportColumn::make('db_notification')
                ->label(__('In-App Notification')),
            ImportColumn::make('db_notification_title')
                ->label(__('In-App Notification Title')),
            ImportColumn::make('db_notification_description')
                ->label(__('In-App Notification Description')),
            ImportColumn::make('enabled')
                ->label(__('Enabled')),
            ImportColumn::make('order')
                ->label(__('Order')),
            ImportColumn::make('settings_title')
                ->label(__('Settings Title')),
            ImportColumn::make('has_settings')
                ->label(__('Has Settings')),
        ];
    }

    public function resolveRecord(): ?NotificationTemplate
    {
        if (isset($this->data['Id']) && $this->data['Id']) {
            return NotificationTemplate::firstOrNew([
                'id' => $this->data['Id'],
            ]);
        }
        if (isset($this->data['id']) && $this->data['id']) {
            return NotificationTemplate::firstOrNew([
                'id' => $this->data['id'],
            ]);
        }

        return new NotificationTemplate();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your notification template import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
