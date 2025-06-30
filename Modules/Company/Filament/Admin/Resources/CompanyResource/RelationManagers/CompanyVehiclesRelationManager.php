<?php

namespace Modules\Company\Filament\Admin\Resources\CompanyResource\RelationManagers;

use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\RelationManagers\RelationManager;

class CompanyVehiclesRelationManager extends RelationManager
{
    protected static string $relationship = 'vehicles';

    protected static ?string $inverseRelationship = 'company';

    protected static ?string $title = 'Company Vehicles';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('model.name')
                    ->label(__('Model'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('plate_number')
                    ->label(__('Plate Number')),
                Tables\Columns\TextColumn::make('color')
                    ->label(__('Color')),
                Tables\Columns\TextColumn::make('vin_number')
                    ->label(__('VIN Number')),
                Tables\Columns\TextColumn::make('year')
                    ->label(__('Year')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    protected static function getModelLabel(): string
    {
        return __('Company Vehicle');
    }

    public static function getTitle(Model $model, string $pageClass): string
    {
        return __('Company Vehicles');
    }

    public static function getLabel(): ?string
    {
        return __('Company Vehicle');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Company Vehicles');
    }
}
