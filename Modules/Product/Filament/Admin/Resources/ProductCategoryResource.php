<?php

namespace Modules\Product\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Filament\Admin\Resources\ProductCategoryResource\Pages;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Product Category Information'))
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label(__('Name'))
                            ->required(),
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->label(__('Order'))
                            ->required(),
                        Forms\Components\Select::make('parent_id')
                            ->label(__('Parent Category'))
                            ->relationship('parent', 'name->en', function (Builder $query) {
                                return $query->whereNull('parent_id');
                            })
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('company_id')
                            ->label(__('Company'))
                            ->relationship('company', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->label(__('Description'))
                            ->rows(5)
                            ->columnSpanFull(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name')),
                Tables\Columns\TextColumn::make('order')
                    ->label(__('Order')),
                Tables\Columns\TextColumn::make('parent.name')
                    ->label(__('Parent Category')),
                Tables\Columns\TextColumn::make('company.name')
                    ->label(__('Company')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('parent_id')
                    ->label(__('Parent Category'))
                    ->relationship('parent', 'name->' . app()->getLocale(), function (Builder $query) {
                        return $query->whereNull('parent_id');
                    })
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $query->when(
                    request()->query('parent_id'),
                    fn(Builder $query, $parentId) => $query->where('parent_id', $parentId),
                    fn(Builder $query) => $query->whereNull('parent_id')
                );
            })
            ->headerActions([
                Tables\Actions\Action::make('all')
                    ->label(__('All main categories'))
                    ->url(fn() => route('filament.admin.resources.product-categories.index'))
                    ->badge()
                    ->color(request()->query('parent_id') ? 'gray' : 'primary'),
                ...static::getParentCategories()->map(function ($category) {
                    $isActive = request()->query('parent_id') == $category->id;
                    return Tables\Actions\Action::make($category->id)
                        ->label($category->getTranslation('name', app()->getLocale()))
                        ->url(fn() => route('filament.admin.resources.product-categories.index', ['parent_id' => $category->id]))
                        ->badge()
                        ->color($isActive ? 'primary' : 'gray');
                })->toArray(),
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
            'index' => Pages\ListProductCategories::route('/'),
            'create' => Pages\CreateProductCategory::route('/create'),
            'edit' => Pages\EditProductCategory::route('/{record}/edit'),
            'view' => Pages\ViewProductCategory::route('/{record}'),
        ];
    }

    protected static function getParentCategories()
    {
        return ProductCategory::whereNull('parent_id')->orderBy('order', 'asc')->get();
    }

    public static function getLabel(): ?string
    {
        return __('Product Category');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Product Categories');
    }

    public static function getNavigationGroup(): string
    {
        return __('Products');
    }
}
