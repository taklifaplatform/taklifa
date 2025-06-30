<?php

namespace Modules\Vehicle\Filament\Admin\Resources\VehicleResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\RelationManagers\RelationManager;

class CapacityWeightRelationManager extends RelationManager
{
    protected static string $relationship = 'capacityWeight';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
               Forms\Components\Section::make(__(''))
                    ->schema([
                        Forms\Components\TextInput::make('value')
                            ->label(__('Value')),

                        Forms\Components\TextInput::make('unit')
                            ->label(__('Unit')),
                    ])
                    ->columns(2)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('value')
                    ->label(__('Value')),

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

    protected static function getModelLabel(): string
    {
        return __('Capacity Weight');
    }

    public static function getTitle(Model $model, string $pageClass): string
    {
        return __('Capacity Weight');
    }
}
