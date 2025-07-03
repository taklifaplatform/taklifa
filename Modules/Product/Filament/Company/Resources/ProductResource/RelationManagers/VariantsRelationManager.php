<?php

namespace Modules\Product\Filament\Company\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
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
                        Forms\Components\TextInput::make('price')
                            ->label(__('Price'))
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('price_currency')
                            ->label(__('Price Currency'))
                            ->required()
                            ->default('SAR'),
                    ])->columns(2)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table

            ->columns([
                Tables\Columns\TextColumn::make('price')
                ->label(__('Price')),
             Tables\Columns\TextColumn::make('price_currency')
                ->label(__('Price Currency')),
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
            ])
            ->defaultSort('price', 'asc');
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