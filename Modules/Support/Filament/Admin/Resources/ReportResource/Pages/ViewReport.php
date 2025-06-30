<?php

namespace Modules\Support\Filament\Admin\Resources\ReportResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Resources\Pages\ViewRecord;
use Modules\User\Filament\Admin\Resources\UserResource;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Modules\Support\Filament\Admin\Resources\ReportResource;
use Modules\Support\Filament\Admin\Resources\ReportReasonResource;

class ViewReport extends ViewRecord
{
    protected static string $resource = ReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make(__('Report Information'))
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(3)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('user.name')
                                            ->label(__('User'))
                                            ->visible(fn ($record) => $record->user)
                                            ->url(function ($record) {
                                                return UserResource::getUrl('view', ['record' => $record->user->id]);
                                            })
                                            ->size(TextEntrySize::Medium),

                                        Components\TextEntry::make('reason.name')
                                            ->label(__('Reason'))
                                            ->visible(fn ($record) => $record->reason)
                                            ->url(function ($record) {
                                                return ReportReasonResource::getUrl('index', ['record' => $record->reason->id]);
                                            })
                                            ->size(TextEntrySize::Medium),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('status')
                                            ->formatStateUsing(function ($state) {
                                                return ucwords(str_replace('_', ' ', $state));
                                            })
                                            ->label(__('Status'))
                                            ->badge()
                                            ->color(function ($record) {
                                                if ($record->status === 'pending') {
                                                    return 'warning';
                                                }

                                                if ($record->status === 'resolved') {
                                                    return 'success';
                                                }
                                            }),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('created_at')
                                            ->label(__('Created at'))
                                            ->dateTime()
                                            ->color('success')
                                            ->badge(),

                                        Components\TextEntry::make('updated_at')
                                            ->label(__('Updated at'))
                                            ->dateTime()
                                            ->badge(),
                                    ]),
                                ]),

                        ])->from('lg'),
                    ]),

                Components\Section::make(__('Message'))
                    ->schema([
                        Components\TextEntry::make('message')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),
            ]);
    }
}
