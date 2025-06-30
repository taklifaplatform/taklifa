<?php

namespace Modules\Geography\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Modules\Geography\Entities\Tax;
use Filament\Forms\Components\Section;
use Modules\Geography\Filament\Admin\Resources\TaxResource\Pages;

class TaxResource extends Resource
{
    protected static ?string $model = Tax::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('Basic Information'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('Name'))
                            ->unique(ignoreRecord: true)
                            ->required(),
                        Forms\Components\TextInput::make('cca3')
                            ->label(__('CCA3'))
                            ->maxLength(5)
                            ->required(),

                        Forms\Components\TextInput::make('cca2')
                            ->label(__('CCA2'))
                            ->maxLength(3)
                            ->required(),
                    ]),

                Section::make(__('Type'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('tax_type')
                            ->label(__('Tax Type')),
                        Forms\Components\TextInput::make('generic_label')
                            ->label(__('Generic Label')),
                        Forms\Components\TextInput::make('vat_id')
                            ->label(__('VAT ID')),
                        Forms\Components\TextInput::make('zone')
                            ->label(__('Zone')),
                    ]),

                Section::make(__('Rates'))
                    ->columns(1)
                    ->schema([
                        Forms\Components\Repeater::make(__('Rates'))
                            ->schema([
                                Forms\Components\Checkbox::make('default')
                                    ->label(__('Default')),
                                Forms\Components\TextInput::make('id')
                                    ->label(__('ID')),
                                Forms\Components\TextInput::make('name')
                                    ->label(__('Name')),
                                Forms\Components\Repeater::make('amounts')
                                    ->label(__('Amounts'))
                                    ->schema([
                                        Forms\Components\TextInput::make('id')
                                            ->label(__('ID')),
                                        Forms\Components\TextInput::make('amount')
                                            ->label(__('Amount')),
                                        Forms\Components\DatePicker::make('start_date')
                                            ->label(__('Start Date')),

                                    ])
                                    ->columns(2),
                            ])
                            ->columns(1),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country.name')
                    ->label(__('Country'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('tax_type')
                    ->label(__('Tax Type'))
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListTaxes::route('/'),
            'create' => Pages\CreateTax::route('/create'),
            'edit' => Pages\EditTax::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Geography');
    }

    public static function getLabel(): ?string
    {
        return __('Tax');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Taxes');
    }
}
