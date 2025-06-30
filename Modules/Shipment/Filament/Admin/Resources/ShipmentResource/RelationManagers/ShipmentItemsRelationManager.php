<?php

namespace Modules\Shipment\Filament\Admin\Resources\ShipmentResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\RelationManagers\RelationManager;

class ShipmentItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Shipment Items';

    protected static ?string $label = 'Shipment Items';

    protected static ?string $inverseRelationship = 'shipment';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__(''))
                    ->schema([
                        Forms\Components\TextInput::make('dim_unit')
                            ->default('cm')
                            ->label(__('Dim Unit')),

                        Forms\Components\TextInput::make('dim_width')
                            ->label(__('Dim Width'))
                            ->numeric(),
                        Forms\Components\TextInput::make('dim_length')
                            ->label(__('Dim Length'))
                            ->numeric(),

                        Forms\Components\TextInput::make('dim_height')
                            ->label(__('Dim Height'))
                            ->numeric(),

                        Forms\Components\TextInput::make('cap_weight')
                            ->label(__('Cap Weight'))
                            ->numeric(),
                        Forms\Components\TextInput::make('cap_unit')
                            ->default('kg')
                            ->label(__('Cap Unit')),

                        Forms\Components\TextInput::make('content')
                            ->label(__('Content')),

                        Forms\Components\TextInput::make('content_value')
                            ->label(__('Content Value')),

                        Forms\Components\RichEditor::make('notes')
                            ->label(__('Notes'))
                            ->columnSpan('full'),
                    ])
                    ->columns(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modelLabel(__('Shipment Item'))
            ->heading(__('Shipment Items'))
            ->columns([
                Tables\Columns\TextColumn::make('dim_width')
                    ->numeric()
                    ->label(__('Dim Width')),
                Tables\Columns\TextColumn::make('dim_height')
                    ->numeric()
                    ->label(__('Dim Height')),
                Tables\Columns\TextColumn::make('dim_length')
                    ->numeric()
                    ->label(__('Dim Length')),
                Tables\Columns\TextColumn::make('dim_unit')
                    ->numeric()
                    ->label(__('Dim Unit')),

                Tables\Columns\TextColumn::make('cap_unit')
                    ->label(__('Cap Unit')),
                Tables\Columns\TextColumn::make('cap_weight')
                    ->numeric()
                    ->label(__('Cap Weight')),
                Tables\Columns\TextColumn::make('content')
                    ->limit(50)
                    ->label(__('Content')),
                Tables\Columns\TextColumn::make('content_value')
                    ->label(__('Content Value')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
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

    public static function getLabel(): ?string
    {
        return __('Shipment Item');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Shipment Items');
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Shipment Items');
    }
}
