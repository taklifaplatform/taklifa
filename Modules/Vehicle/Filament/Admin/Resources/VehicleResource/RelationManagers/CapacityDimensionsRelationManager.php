<?php

namespace Modules\Vehicle\Filament\Admin\Resources\VehicleResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\RelationManagers\RelationManager;

class CapacityDimensionsRelationManager extends RelationManager
{
    protected static string $relationship = 'capacityDimensions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__(''))
                    ->schema([
                        Forms\Components\TextInput::make('width')
                            ->numeric()
                            ->label(__('Width')),

                        Forms\Components\TextInput::make('height')
                            ->numeric()
                            ->label(__('Height')),

                        Forms\Components\TextInput::make('length')
                            ->numeric()
                            ->label(__('Length')),
                        Forms\Components\Select::make('unit')
                            ->label(__('Unit'))
                            ->options([
                                'm' => 'm',
                                'cm' => 'cm',
                                'mm' => 'mm',
                            ]),
                    ])
                    ->columns(2)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('width')
                    ->label(__('Width')),

                Tables\Columns\TextColumn::make('height')
                    ->label(__('Height')),

                Tables\Columns\TextColumn::make('length')
                    ->label(__('Length')),

                Tables\Columns\TextColumn::make('unit')
                    ->label(__('Unit')),
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

    public static function getTitle(Model $model, string $pageClass): string
    {
        return __('Capacity Dimensions');
    }

    protected static function getModelLabel(): string
    {
        return __('Capacity Dimensions');
    }
}
