<?php

namespace Modules\Geography\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Modules\Geography\Entities\Currency;
use Modules\Geography\Filament\Admin\Resources\CurrencyResource\Pages;

class CurrencyResource extends Resource
{
    protected static ?string $model = Currency::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('Basic Information'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('title.en')
                            ->label(__('Name (English)'))
                            ->required(),
                        Forms\Components\TextInput::make('title.ar')
                            ->label(__('Name (Arabic)'))
                            ->required(),
                        Forms\Components\TextInput::make('iso_code')
                            ->label(__('ISO Code'))
                            ->required(),
                        Forms\Components\TextInput::make('iso_number')
                            ->label(__('ISO Number'))
                            ->required(),
                        Forms\Components\TextInput::make('sort')
                            ->label(__('Sort'))
                            ->required(),
                    ]),

                Section::make(__('Units'))
                    ->columns(2)
                    ->schema([
                        Section::make(__('Major'))
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('units.major.name')
                                    ->label(__('Name')),
                                Forms\Components\TextInput::make('units.major.symbol')
                                    ->label(__('Symbol'))
                                    ->required(),
                            ]),
                        Section::make(__('Minor'))
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('units.minor.name')
                                    ->label(__('Name')),
                                Forms\Components\TextInput::make('units.minor.symbol')
                                    ->label(__('Symbol')),
                                Forms\Components\TextInput::make('units.minor.majorValue')
                                    ->label(__('Major Value')),
                            ]),
                    ]),

                Section::make(__('Coins'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('coins.frequent')
                            ->label(__('Frequent')),
                        Forms\Components\TextInput::make('coins.rare')
                            ->label(__('Rare')),
                    ]),

                Section::make(__('Bank Notes'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('coins.frequent')
                            ->label(__('Frequent')),
                        Forms\Components\TextInput::make('coins.rare')
                            ->label(__('Rare')),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Name'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('units.major.symbol')
                    ->label(__('Symbol'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort')
                    ->label(__('Sort'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('iso_code')
                    ->label(__('ISO Code')),
                Tables\Columns\TextColumn::make('iso_number')
                    ->label(__('ISO Number')),
            ])
            ->filters([
                //
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
            'index' => Pages\ListCurrencies::route('/'),
            'create' => Pages\CreateCurrency::route('/create'),
            'edit' => Pages\EditCurrency::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Geography');
    }

    public static function getLabel(): ?string
    {
        return __('Currency');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Currencies');
    }
}
