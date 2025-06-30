<?php

namespace Modules\Shipment\Filament\Admin\Resources\ShipmentResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Modules\Shipment\Entities\Shipment;
use Filament\Resources\Pages\ViewRecord;
use Modules\User\Filament\Admin\Resources\UserResource;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Modules\Shipment\Filament\Admin\Resources\ShipmentResource;
use Modules\Geography\Filament\Admin\Resources\LocationResource;

class ViewShipment extends ViewRecord
{
    protected static string $resource = ShipmentResource::class;

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
                Components\Section::make(__('Shipment Information'))
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(7)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('user.username')
                                            ->label(__('User'))
                                            ->visible(fn($record) => $record->user)
                                            ->url(function ($record) {
                                                return UserResource::getUrl('view', ['record' => $record->user]);
                                            })
                                            ->formatStateUsing(function ($record) {
                                                return Str::title(str_replace('_', ' ', $record->user->username));
                                            }),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('fromLocation.address')
                                            ->label(__('From Location'))
                                            ->visible(fn($record) => $record->fromLocation)
                                            ->url(function ($record) {
                                                return LocationResource::getUrl('index', ['record' => $record->fromLocation]);
                                            }),

                                        Components\TextEntry::make('recipient_name')
                                            ->label(__('Recipient Name'))
                                            ->size(TextEntrySize::Medium),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('toLocation.address')
                                            ->label(__('To Location'))
                                            ->visible(fn($record) => $record->toLocation)
                                            ->url(function ($record) {
                                                return LocationResource::getUrl('index', ['record' => $record->toLocation]);
                                            }),

                                        Components\TextEntry::make('recipient_phone')
                                            ->label(__('Recipient Phone'))
                                            ->size(TextEntrySize::Medium),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('pick_date')
                                            ->date()
                                            ->badge()->color(function ($record) {
                                                if ($record->pick_date >= now()) {
                                                    return 'success';
                                                } elseif ($record->pick_date < now()) {
                                                    return 'danger';
                                                } else {
                                                    return null;
                                                }
                                            })
                                            ->label(__('Pick Date')),
                                        Components\TextEntry::make('pick_time')
                                            ->time()
                                            ->badge()
                                            ->label(__('Pick Time')),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('deliver_date')
                                            ->date()
                                            ->badge()
                                            ->color(function ($record) {
                                                if ($record->deliver_date >= now()) {
                                                    return 'success';
                                                } elseif ($record->deliver_date < now()) {
                                                    return 'danger';
                                                } else {
                                                    return null;
                                                }
                                            })
                                            ->label(__('Deliver Date')),
                                        Components\TextEntry::make('deliver_time')
                                            ->time()
                                            ->badge()
                                            ->label(__('Deliver Time')),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('items_type')
                                            ->formatStateUsing(function ($state) {
                                                return ucwords(str_replace('_', ' ', $state));
                                            })
                                            ->label(__('Items Type')),

                                        Components\TextEntry::make('status')
                                            ->badge()
                                            ->color(fn($record) => match ($record->status) {
                                                Shipment::STATUS_DRAFT => 'gray',
                                                Shipment::STATUS_SEARCHING => 'primary',
                                                Shipment::STATUS_ASSIGNED => 'success',
                                                Shipment::STATUS_DELIVERING => 'info',
                                                Shipment::STATUS_DELIVERED => 'success',
                                                Shipment::STATUS_CANCELLED => 'danger',
                                                Shipment::STATUS_PENDING => 'primary',
                                                Shipment::STATUS_EXPIRED => 'danger',
                                                Shipment::STATUS_REJECTED => 'danger',
                                                Shipment::STATUS_COMPLETED => 'success',
                                            })
                                            ->formatStateUsing(function ($state) {
                                                return ucwords(str_replace('_', ' ', $state));
                                            })
                                            ->label(__('Status'))
                                            ->size(TextEntrySize::Medium),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('minBudget.value')
                                            ->label(__('Min Budget'))
                                            ->money()
                                            ->size(TextEntrySize::Medium),

                                        Components\TextEntry::make('maxBudget.value')
                                            ->label(__('Max Budget'))
                                            ->money()
                                            ->size(TextEntrySize::Medium),
                                    ]),
                                ]),

                        ])->from('lg'),
                    ]),
            ]);
    }
}
