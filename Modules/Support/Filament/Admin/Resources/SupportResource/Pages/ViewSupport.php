<?php

namespace Modules\Support\Filament\Admin\Resources\SupportResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\IconPosition;
use Modules\User\Filament\Admin\Resources\UserResource;
use Modules\Support\Filament\Admin\Resources\SupportResource;
use Modules\Support\Filament\Admin\Resources\SupportCategoryResource;

class ViewSupport extends ViewRecord
{
    protected static string $resource = SupportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make(__('Support Information'))
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(4)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('user.name')
                                            ->label(__('User'))
                                            ->visible(fn ($record) => $record->user)
                                            ->url(function ($record) {
                                                return UserResource::getUrl('view', ['record' => $record->user->id]);
                                            }),

                                        Components\TextEntry::make('category.name')
                                            ->label(__('Category'))
                                            ->visible(fn ($record) => $record->category)
                                            ->url(function ($record) {
                                                return SupportCategoryResource::getUrl('index', ['record' => $record->category->id]);
                                            }),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('email')
                                            ->label(__('Email'))
                                            ->icon('heroicon-m-envelope')
                                            ->iconPosition(IconPosition::Before)
                                            ->iconColor('primary'),

                                        Components\TextEntry::make('phone_number')
                                            ->label(__('Phone Number'))
                                            ->icon('heroicon-s-phone')
                                            ->iconPosition(IconPosition::Before)
                                            ->iconColor('primary'),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('subject')
                                            ->label(__('Subject')),

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
