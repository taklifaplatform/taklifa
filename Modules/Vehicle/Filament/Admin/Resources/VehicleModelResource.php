<?php

namespace Modules\Vehicle\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Modules\Vehicle\Entities\VehicleModel;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Modules\Vehicle\Filament\Admin\Resources\VehicleModelResource\Pages;

class VehicleModelResource extends Resource
{
    protected static ?string $model = VehicleModel::class;

    public static function form(Form $form): Form
    {
        $sizes = ['$1', '$2', '$3', '$4', '$5', '$6', '$7', '$8', '$9', '$10', '$11', '$12', '$13', '$14', '$15', '$16', '$17', '$18', '$19', '$20'];
        $options = array_combine($sizes, $sizes);

        return $form
            ->schema([
                Forms\Components\Section::make(__('Vehicle Model Information'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name.en')
                            ->autofocus()
                            ->required()
                            ->label(__('Name (English)')),

                        Forms\Components\TextInput::make('name.ar')
                            ->autofocus()
                            ->required()
                            ->label(__('Name (Arabic)')),
                    ]),

                Forms\Components\Section::make(__('Vehicle Make'))
                    ->columns(2)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('map_icon')
                            ->label(__('Map Icon'))
                            ->collection('map_icon')
                            ->image()
                            ->imageEditor(),

                        SpatieMediaLibraryFileUpload::make('list_icon')
                            ->label(__('List Icon'))
                            ->collection('list_icon')
                            ->image()
                            ->imageEditor(),
                    ]),

                Forms\Components\Section::make(__('Size On Map'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('map_icon_width')
                            ->required()
                            ->default('$4')
                            ->options($options)
                            ->label(__('Icon Width')),
                        Forms\Components\Select::make('map_icon_height')
                            ->required()
                            ->default('$1')
                            ->options($options)
                            ->label(__('Icon Height')),
                    ]),

                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->required()
                    ->label(__('Order')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'asc')
            ->defaultPaginationPageOption(50)
            ->reorderable('order')
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->sortable()
                    ->label(__('Order')),
                SpatieMediaLibraryImageColumn::make('map_icon')
                    ->label(__('Map Icon'))
                    ->collection('map_icon'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(__('Name')),
                Tables\Columns\TextColumn::make('map_icon_width')
                    ->label(__('Map Icon Width')),
                Tables\Columns\TextColumn::make('map_icon_height')
                    ->label(__('Map Icon Height')),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVehicleModels::route('/'),
            'create' => Pages\CreateVehicleModel::route('/create'),
            'edit' => Pages\EditVehicleModel::route('/{record}/edit'),
            'view' => Pages\ViewVehicleModel::route('/{record}'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('Vehicle Model');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Vehicle Model');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Vehicles');
    }

    public static function getNavigationParentItem(): string
    {
        return __('Vehicle');
    }
}
