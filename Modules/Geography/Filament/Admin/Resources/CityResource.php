<?php

namespace Modules\Geography\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Modules\Geography\Entities\City;
use Modules\Geography\Filament\Admin\Resources\CityResource\Pages;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-c-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name.en')
                    ->label(__('Name (English)'))
                    ->required(),
                Forms\Components\TextInput::make('name.ar')
                    ->label(__('Name (Arabic)'))
                    ->required(),
                Forms\Components\TextInput::make('ref')
                    ->label(__('Reference'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label(__('Name')),
                Tables\Columns\TextColumn::make('timezone')
                ->sortable()
                ->searchable()
                    ->label(__('Timezone')),

                Tables\Columns\TextColumn::make('wikidata_id')
                    ->label(__('Wikidata ID')),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCities::route('/'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Geography');
    }

    public static function getLabel(): ?string
    {
        return __('City');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Cities');
    }
}
