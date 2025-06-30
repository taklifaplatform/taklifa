<?php

namespace Modules\Notification\Filament\Admin\Resources\NotificationTemplateResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Modules\Notification\Filament\Admin\Resources\NotificationTemplateResource;

class ViewNotificationTemplate extends ViewRecord
{
    protected static string $resource = NotificationTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        $record = $this->getRecord();

        return $this->formatTitle($record->type) ?? 'View Notification Template';
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make(__('Notification Type Details'))
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(4)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('type')
                                            ->label(__('Type'))
                                            ->formatStateUsing(function ($state) {
                                                return ucwords(str_replace('_', ' ', $state));
                                            })
                                            ->size(TextEntrySize::Medium),

                                        Components\IconEntry::make('enabled')
                                            ->label(__('Enabled'))
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->boolean()
                                    ]),

                                    Components\Group::make([
                                        Components\IconEntry::make('icon_user_avatar')
                                            ->label(__('Icon User Avatar'))
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->boolean(),

                                        Components\IconEntry::make('icon_rounded')
                                            ->label(__('Icon Rounded'))
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->boolean()
                                    ]),

                                    Components\Group::make([
                                        Components\IconEntry::make('email_notification')
                                            ->label(__('Email Notification'))
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->boolean(),

                                        Components\IconEntry::make('db_notification')
                                            ->label(__('DB Notification'))
                                            ->trueIcon('heroicon-o-check-badge')
                                            ->falseIcon('heroicon-o-x-mark')
                                            ->boolean()
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('created_at')
                                            ->label(__('Created At'))
                                            ->color('success')
                                            ->badge(),

                                        Components\TextEntry::make('updated_at')
                                            ->label(__('Updated At'))
                                            ->badge()
                                    ]),
                                ]),

                        ])->from('lg'),
                    ]),

            ]);
    }

    private function formatTitle(string $type): string
    {
        $formattedTitle = str_replace('_', ' ', strtolower($type));
        $formattedTitle = ucwords($formattedTitle);
        $words = explode(' ', $formattedTitle);
        $words[0] = ucfirst(strtolower($words[0]));
        return implode(' ', $words);
    }
}
