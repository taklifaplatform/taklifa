<?php

namespace Modules\Geography\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Modules\Geography\Entities\Country;
use Filament\Resources\Concerns\Translatable;
use Modules\Geography\Filament\Admin\Resources\CountryResource\Pages;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-s-globe-americas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name.en')
                            ->required()
                            ->label(__('Name (English)')),
                        Forms\Components\TextInput::make('name.ar')
                            ->required()
                            ->label(__('Name (Arabic)')),
                        Forms\Components\TextInput::make('name.fr')
                            ->required()
                            ->label(__('Name (French)')),
                        Forms\Components\TextInput::make('code')
                            ->required()
                            ->label(__('Code')),
                        Forms\Components\TextInput::make('wikidata_id')
                            ->required()
                            ->label(__('Wikidata ID')),
                        Forms\Components\TextInput::make('flag')
                            ->label(__('Flag')),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('flag')
                    ->label(__('Flag')),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label(__('Name')),
                Tables\Columns\TextColumn::make('code')
                    ->sortable()
                    ->label(__('Code')),
                Tables\Columns\TextColumn::make('wikidata_id')
                    ->label(__('Wikidata ID')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountries::route('/create'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Geography');
    }

    public static function getLabel(): ?string
    {
        return __('Country');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Countries');
    }
}
