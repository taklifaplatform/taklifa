<?php

namespace Modules\Vehicle\Filament\Admin\Resources\VehicleResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\RelationManagers\RelationManager;

class FuelInformationRelationManager extends RelationManager
{
    protected static string $relationship = 'fuelInformation';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__(''))
                    ->schema([
                        Forms\Components\TextInput::make('fuel_type')
                            ->label(__('Fuel Type')),

                        Forms\Components\TextInput::make('fuel_capacity')
                            ->label(__('Fuel Capacity')),

                        Forms\Components\TextInput::make('liter_per_km_in_city')
                            ->label(__('Liter Per Km In City')),

                        Forms\Components\TextInput::make('liter_per_km_in_highway')
                            ->label(__('Liter Per Km In Highway')),

                        Forms\Components\TextInput::make('liter_per_km_mixed')
                            ->label(__('Liter Per Km Mixed')),
                    ])
                    ->columns(2)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fuel_type')
                    ->label(__('Fuel Type')),

                Tables\Columns\TextColumn::make('fuel_capacity')
                    ->label(__('Fuel Capacity')),

                Tables\Columns\TextColumn::make('liter_per_km_in_city')
                    ->label(__('Liter Per Km In City')),

                Tables\Columns\TextColumn::make('liter_per_km_in_highway')
                    ->label(__('Liter Per Km In Highway')),

                Tables\Columns\TextColumn::make('liter_per_km_mixed')
                    ->label(__('Liter Per Km Mixed')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected static function getModelLabel(): string
    {
        return __('Fuel Information');
    }

    public static function getTitle(Model $model, string $pageClass): string
    {
        return __('Fuel Information');
    }
}
