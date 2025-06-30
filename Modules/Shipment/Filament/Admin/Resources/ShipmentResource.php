<?php

namespace Modules\Shipment\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Modules\Shipment\Entities\Shipment;
use Modules\Shipment\Filament\Admin\Resources\ShipmentResource\Pages;
use Modules\Shipment\Filament\Admin\Resources\ShipmentResource\RelationManagers\ShipmentItemsRelationManager;
use Modules\Shipment\Filament\Admin\Resources\ShipmentResource\RelationManagers\ShipmentInvitationsRelationManager;

class ShipmentResource extends Resource
{
    protected static ?string $model = Shipment::class;

    protected static ?string $label = 'Shipment';

    protected static ?string $navigationIcon = 'heroicon-s-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Shipment Information'))
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label(__('User'))
                            ->columnSpan('full')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('user', 'username'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('Pickup Information'))
                    ->schema([
                        Forms\Components\DatePicker::make('pick_date')
                            ->label(__('Pick Date')),
                        Forms\Components\TimePicker::make('pick_time')
                            ->label(__('Pick Time')),

                        Forms\Components\DatePicker::make('deliver_date')
                            ->label(__('Deliver Date')),
                        Forms\Components\TimePicker::make('deliver_time')
                            ->label(__('Deliver Time')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('Recipient Information'))
                    ->schema([
                        Forms\Components\TextInput::make('recipient_name')
                            ->label(__('Recipient Name')),
                        Forms\Components\TextInput::make('recipient_phone')
                            ->label(__('Recipient Phone')),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('Shipment Details'))
                    ->schema([
                        Forms\Components\Select::make('items_type')
                            ->label(__('Items Type'))
                            ->options([
                                Shipment::ITEMS_TYPE_DOCUMENT => __('document'),
                                Shipment::ITEMS_TYPE_BOX => __('box'),
                                Shipment::ITEMS_TYPE_MULTIPLE_BOXES => __('multiple_boxes'),
                                Shipment::ITEMS_TYPE_OTHER => __('other'),

                            ]),
                        Forms\Components\Select::make('status')
                            ->label(__('Status'))
                            ->options([
                                Shipment::STATUS_DRAFT => __('draft'),
                                Shipment::STATUS_SEARCHING => __('searching'),
                                Shipment::STATUS_ASSIGNED => __('assigned'),
                                Shipment::STATUS_DELIVERING => __('delivering'),
                                Shipment::STATUS_DELIVERED => __('delivered'),
                                Shipment::STATUS_CANCELLED => __('cancelled'),
                                Shipment::STATUS_PENDING => __('pending'),
                                Shipment::STATUS_EXPIRED => __('expired'),
                                Shipment::STATUS_REJECTED => __('rejected'),
                                Shipment::STATUS_COMPLETED => __('completed'),
                            ]),
                    ])
                    ->columns(2),

                Forms\Components\Section::make(__('Budget Information'))
                    ->schema([
                        Forms\Components\Section::make(__('Min'))
                            ->schema([
                                Forms\Components\Select::make('min_budget_id')
                                    ->relationship('minBudget', 'value')
                                    ->label(__('Value'))
                                    ->reactive()
                                    ->searchable()
                                    ->preload()
                                    ->afterStateUpdated(function ($set, $get, $state) {
                                        if ($get('max_budget_id') === $state) {
                                            $set('max_budget_id', null);
                                        }
                                    }),
                            ]),
                        Forms\Components\Section::make(__('Max'))
                            ->schema([
                                Forms\Components\Select::make('max_budget_id')
                                    ->relationship('maxBudget', 'value')
                                    ->label(__('Value'))
                                    ->reactive()
                                    ->searchable()
                                    ->preload()
                                    ->afterStateUpdated(function ($set, $get, $state) {
                                        if ($get('min_budget_id') === $state) {
                                            $set('min_budget_id', null);
                                        }
                                    }),
                            ]),
                    ])
                    ->columns(2),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->formatStateUsing(function ($record) {
                        return Str::title(str_replace('_', ' ', $record->user->username));
                    })
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->label(__('User')),
                Tables\Columns\TextColumn::make('fromLocation.address')
                    ->searchable()
                    ->sortable()
                    ->label(__('From Location')),
                Tables\Columns\TextColumn::make('toLocation.address')
                    ->searchable()
                    ->sortable()
                    ->label(__('To Location')),

                Tables\Columns\TextColumn::make('pick_date')
                    ->badge()
                    ->color(function ($record) {
                        if ($record->pick_date >= now()) {
                            return 'success';
                        } elseif ($record->pick_date < now()) {
                            return 'danger';
                        } else {
                            return null;
                        }
                    })
                    ->date()
                    ->label(__('Pick Date')),
                Tables\Columns\TextColumn::make('pick_time')
                    ->time()
                    ->label(__('Pick Time')),

                Tables\Columns\TextColumn::make('deliver_date')
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
                    ->date()
                    ->label(__('Deliver Date')),
                Tables\Columns\TextColumn::make('deliver_time')
                    ->time()
                    ->label(__('Deliver Time')),

                Tables\Columns\TextColumn::make('recipient_name')
                    ->label(__('Recipient Name')),
                Tables\Columns\TextColumn::make('recipient_phone')
                    ->label(__('Recipient Phone')),

                Tables\Columns\TextColumn::make('items_type')
                    ->formatStateUsing(function ($record) {
                        return Str::title(str_replace('_', ' ', $record->items_type));
                    })
                    ->label(__('Items Type')),
                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(function ($state) {
                        return ucwords(str_replace('_', ' ', $state));
                    })
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
                    ->label(__('Status')),

                Tables\Columns\TextColumn::make('minBudget.value')
                    ->money()
                    ->label(__('Min Budget')),
                Tables\Columns\TextColumn::make('maxBudget.value')
                    ->money()
                    ->label(__('Max Budget')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ShipmentItemsRelationManager::class,
            ShipmentInvitationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShipments::route('/'),
            'create' => Pages\CreateShipment::route('/create'),
            'edit' => Pages\EditShipment::route('/{record}/edit'),
            'view' => Pages\ViewShipment::route('/{record}'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('Shipment');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Shipments');
    }
}
