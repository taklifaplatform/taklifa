<?php

namespace Modules\Geography\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Dotswan\MapPicker\Fields\Map;
use Modules\Geography\Entities\Location;
use Modules\Geography\Filament\Admin\Resources\LocationResource\Pages;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static bool $shouldRegisterNavigation = true;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'manage',
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('latitude')
                            ->label(__('Latitude')),
                        Forms\Components\TextInput::make('longitude')
                            ->label(__('Longitude')),
                        Forms\Components\TextInput::make('address')
                            ->label(__('Address'))
                            ->afterStateUpdated(function (Set $set, $state) {
                                $set('location', ['lat' => 40.4168, 'lng' => -3.7038]);
                            }),

                        Forms\Components\Select::make('city')
                            ->label(__('City'))
                            ->relationship('city', 'name')
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('state')
                            ->label(__('State'))
                            ->relationship('state', 'title')
                            ->searchable(),

                        Forms\Components\Select::make('country')
                            ->label(__('Country'))
                            ->relationship('country', 'name')
                            ->searchable()
                            ->preload(),
                    ]),
                Map::make('location')
                    ->label(__('Location'))
                    ->columnSpanFull()
                    ->defaultLocation(latitude: 40.4168, longitude: -3.7038)
                    ->afterStateUpdated(function (Set $set, ?array $state): void {
                        $set('latitude', $state['lat']);
                        $set('longitude', $state['lng']);
                    })
                    ->afterStateHydrated(function ($state, $record, Set $set): void {
                        if ($record) {
                            $set('location', ['lat' => $record->latitude, 'lng' => $record->longitude]);
                        }
                    })
                    ->extraStyles([
                        'min-height: 40vh',
                        'border-radius: 30px'
                    ])
                    ->liveLocation(true, true, 5000)
                    ->showMarker()
                    ->markerColor("#22c55eff")
                    ->showFullscreenControl()
                    ->showZoomControl()
                    ->draggable()
                    ->tilesUrl("https://tile.openstreetmap.de/{z}/{x}/{y}.png")
                    ->zoom(15)
                    ->detectRetina()
                    ->extraTileControl([])
                    ->extraControl([
                        'zoomDelta' => 1,
                        'zoomSnap' => 2,
                    ]),


                Forms\Components\Hidden::make('locationable_id')
                    ->default(auth()->id()),

                Forms\Components\Hidden::make('locationable_type')
                    ->default(get_class(auth()->user())),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('latitude')
                    ->label(__('Latitude')),
                Tables\Columns\TextColumn::make('longitude')
                    ->label(__('Longitude'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->label(__('Address'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->label(__('City'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('state.title')
                    ->label(__('State'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('country.name')
                    ->label(__('Country'))
                    ->sortable(),
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
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLocations::route('/'),
            'view' => Pages\ViewLocation::route('/{record}'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Geography');
    }

    public static function getLabel(): ?string
    {
        return __('Location');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Locations');
    }
}
