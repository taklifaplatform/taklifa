<?php

namespace Modules\Notification\Filament\Admin\Exports;

use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Models\Export;
use Modules\Notification\Entities\NotificationTemplate;

class NotificationTemplateExporter extends Exporter
{
    protected static ?string $model = NotificationTemplate::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('type')
                ->label(__('Type')),
            ExportColumn::make('icon')
                ->label(__('Icon')),
            ExportColumn::make('icon_user_avatar')
                ->label(__('Icon User Avatar')),
            ExportColumn::make('icon_rounded')
                ->label(__('Icon Rounded')),
            ExportColumn::make('icon_background_color')
                ->label(__('Icon Background Color')),
            ExportColumn::make('sms_notification')
                ->label(__('SMS Notification')),
            ExportColumn::make('sms_notification_title')
                ->label(__('SMS Notification Title')),
            ExportColumn::make('sms_notification_description')
                ->label(__('SMS Notification Description')),
            ExportColumn::make('push_notification')
                ->label(__('Push Notification')),
            ExportColumn::make('push_notification_title')
                ->label(__('Push Notification Title')),
            ExportColumn::make('push_notification_description')
                ->label(__('Push Notification Description')),
            ExportColumn::make('email_notification')
                ->label(__('Email Notification')),
            ExportColumn::make('email_notification_subject')
                ->label(__('Email Notification Subject')),
            ExportColumn::make('email_notification_title')
                ->label(__('Email Notification Title')),
            ExportColumn::make('email_notification_description')
                ->label(__('Email Notification Description')),
            ExportColumn::make('db_notification')
                ->label(__('DB Notification')),
            ExportColumn::make('db_notification_title')
                ->label(__('DB Notification Title')),
            ExportColumn::make('db_notification_description')
                ->label(__('DB Notification Description')),
            ExportColumn::make('enabled')
                ->label(__('Enabled')),
            ExportColumn::make('order')
                ->label(__('Order')),
            ExportColumn::make('settings_title')
                ->label(__('Settings Title')),
            ExportColumn::make('has_settings')
                ->label(__('Has Settings')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your property export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
