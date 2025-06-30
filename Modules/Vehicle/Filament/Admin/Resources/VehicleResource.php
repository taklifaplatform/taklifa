<?php

namespace Modules\Vehicle\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Modules\Vehicle\Entities\Vehicle;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Modules\Vehicle\Filament\Admin\Resources\VehicleResource\Pages;
use Modules\Vehicle\Filament\Admin\Resources\VehicleResource\RelationManagers\InformationRelationManager;
use Modules\Vehicle\Filament\Admin\Resources\VehicleResource\RelationManagers\CapacityWeightRelationManager;
use Modules\Vehicle\Filament\Admin\Resources\VehicleResource\RelationManagers\FuelInformationRelationManager;
use Modules\Vehicle\Filament\Admin\Resources\VehicleResource\RelationManagers\CapacityDimensionsRelationManager;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Vehicle Information'))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->collection('images')
                            ->label(__('Logo Vehicle'))
                            ->image()
                            ->columnSpanFull(),

                        Forms\Components\Select::make('model_id')
                            ->label(__('Model'))
                            ->relationship('model', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\TextInput::make('plate_number')
                            ->label(__('Plate Number')),
                        Forms\Components\TextInput::make('vin_number')
                            ->label(__('VIN Number')),
                        Forms\Components\TextInput::make('year')
                            ->label(__('Year')),
                        Forms\Components\TextInput::make('internal_id')
                            ->label(__('Internal ID')),
                        Forms\Components\ColorPicker::make('color')
                            ->label(__('Color')),

                        Forms\Components\Hidden::make('ownable_id')
                            ->default(auth()->id()),

                        Forms\Components\Hidden::make('ownable_type')
                            ->default(get_class(auth()->user())),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('image')
                    ->label(__('Logo Vehicle')),
                Tables\Columns\TextColumn::make('model.name')
                    ->label(__('Name Model')),
                Tables\Columns\TextColumn::make('plate_number')
                    ->label(__('Plate Number')),
                Tables\Columns\TextColumn::make('vin_number')
                    ->label(__('VIN Number')),
                Tables\Columns\TextColumn::make('year')
                    ->label(__('Year')),
                Tables\Columns\TextColumn::make('color')
                    ->label(__('Color')),
                // Tables\Columns\TextColumn::make('internal_id')
                //     ->label(__('Internal ID')),

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
            InformationRelationManager::class,
            FuelInformationRelationManager::class,
            CapacityDimensionsRelationManager::class,
            CapacityWeightRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
            'view' => Pages\ViewVehicle::route('/{record}'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('Vehicle');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Vehicles');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Vehicles');
    }

    public static function getNavigationLabel(): string
    {
        return __('Vehicle');
    }
}
