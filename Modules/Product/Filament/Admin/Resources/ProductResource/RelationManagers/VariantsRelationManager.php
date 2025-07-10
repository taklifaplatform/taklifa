<?php

namespace Modules\Product\Filament\Admin\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\RelationManagers\RelationManager;

class VariantsRelationManager extends RelationManager
{
    protected static string $relationship = 'variants';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('Name')),

                        Forms\Components\TextInput::make('stock')
                            ->label(__('Stock'))
                            ->numeric()
                            ->integer()
                            ->default(0)
                            ->required(),

                        Forms\Components\TextInput::make('price')
                            ->label(__('Price'))
                            ->numeric()
                            ->required(),

                        Forms\Components\TextInput::make('price_currency')
                            ->label(__('Price Currency'))
                            ->required()
                            ->default('SAR'),

                        Forms\Components\Select::make('type')
                            ->label(__('Type'))
                            ->options([
                                'count' => __('Count'),
                                'weight' => __('Weight'),
                                'size' => __('Size'),
                            ])
                            ->default('count')
                            ->live(),

                        Forms\Components\Select::make('type_unit')
                            ->label(__('Type Unit'))
                            ->options(function (Forms\Get $get) {
                                $type = $get('type');

                                return match ($type) {
                                    'weight' => [
                                        'g' => __('Grams (g)'),
                                        'kg' => __('Kilograms (kg)'),
                                        'lb' => __('Pounds (lb)'),
                                        'oz' => __('Ounces (oz)'),
                                    ],
                                    'size' => [
                                        'cm' => __('Centimeters (cm)'),
                                        'm' => __('Meters (m)'),
                                        'in' => __('Inches (in)'),
                                        'ft' => __('Feet (ft)'),
                                    ],
                                    default => [],
                                };
                            })
                            ->visible(fn(Forms\Get $get) => in_array($get('type'), ['weight', 'size']))
                            ->required(fn(Forms\Get $get) => in_array($get('type'), ['weight', 'size'])),

                        Forms\Components\TextInput::make('type_value')
                            ->label(__('Type Value'))
                            ->numeric()
                            ->step(0.01)
                            ->visible(fn(Forms\Get $get) => $get('type') !== null),

                    ])->columns(2)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label(__('Price'))
                    ->money('SAR'),
                Tables\Columns\TextColumn::make('price_currency')
                    ->label(__('Price Currency')),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('Type'))
                    ->badge(),
                Tables\Columns\TextColumn::make('type_unit')
                    ->label(__('Type Unit')),
                Tables\Columns\TextColumn::make('type_value')
                    ->label(__('Type Value')),
                Tables\Columns\TextColumn::make('stock')
                    ->label(__('Stock')),
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
        return __('Product Variant');
    }

    public static function getTitle(Model $model, string $pageClass): string
    {
        return __('Product Variants');
    }

    public static function getLabel(): ?string
    {
        return __('Product Variant');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Product Variants');
    }
}
