<?php

namespace Modules\Product\Filament\Admin\Resources;

use Modules\Product\Filament\Admin\Resources\ProductResource\RelationManagers\VariantsRelationManager;
use Modules\Product\Filament\Admin\Resources\ProductResource\Pages;
use Modules\Product\Filament\Admin\Resources\ProductResource\RelationManagers;
use Modules\Product\Entities\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box-arrow-down';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Product Information')
                ->schema([
                    Forms\Components\TextInput::make('name')
                       ->label(__('Name'))
                       ->required(),
                    
                    Forms\Components\Select::make('company_id')
                       ->label(__('Company'))
                       ->relationship('company', 'name')
                       ->searchable()
                       ->preload()
                       ->required(),
                    Forms\Components\Textarea::make('description')
                       ->label(__('Description'))
                       ->rows(5)
                       ->columnSpanFull()
                       ->required(),
                    
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label(__('Name')),
                Tables\Columns\TextColumn::make('company.name')
                ->label(__('Company')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            VariantsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('Product');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Products');
    }

    public static function getNavigationGroup(): string
    {
        return __('Products');
    }
}
