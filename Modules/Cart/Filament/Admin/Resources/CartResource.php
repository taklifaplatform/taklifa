<?php

namespace Modules\Cart\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Modules\Cart\Entities\Cart;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Modules\Cart\Filament\Admin\Resources\CartResource\Pages;

class CartResource extends Resource
{
    protected static ?string $model = Cart::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label(__('Cart User'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('company.name')
                    ->label(__('Company'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('total_items')
                    ->label(__('Total Items'))
                    ->numeric()
                    ->sortable(),

                TextColumn::make('total_cost')
                    ->label(__('Total Cost'))
                    ->money('SAR')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label(__('Updated At'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCarts::route('/'),
        ];
    }
}
