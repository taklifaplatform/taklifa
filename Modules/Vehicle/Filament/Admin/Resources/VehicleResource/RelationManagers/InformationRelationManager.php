<?php

namespace Modules\Vehicle\Filament\Admin\Resources\VehicleResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\RelationManagers\RelationManager;

class InformationRelationManager extends RelationManager
{
    protected static string $relationship = 'information';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__(''))
                    ->schema([
                        Forms\Components\TextInput::make('body_type')
                            ->label(__('Body Type')),

                        Forms\Components\TextInput::make('top_speed')
                            ->label(__('Top Speed')),

                        Forms\Components\TextInput::make('doors_count')
                            ->numeric()
                            ->label(__('Doors Count')),

                        Forms\Components\TextInput::make('seats_count')
                            ->numeric()
                            ->label(__('Seats Count')),
                    ])
                    ->columns(2)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table

            ->columns([
                Tables\Columns\TextColumn::make('body_type')
                    ->label(__('Body Type')),

                Tables\Columns\TextColumn::make('top_speed')
                    ->label(__('Top Speed')),

                Tables\Columns\TextColumn::make('doors_count')
                    ->label(__('Doors Count')),

                Tables\Columns\TextColumn::make('seats_count')
                    ->label(__('Seats Count')),
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
        return __('Information');
    }

    public static function getTitle(Model $model, string $pageClass): string
    {
        return __('Information');
    }
}
