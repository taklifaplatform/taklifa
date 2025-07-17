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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

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
                        Forms\Components\TextInput::make('name.en')
                            ->label(__('Name (English)'))
                            ->required(),
                        Forms\Components\TextInput::make('name.ar')
                            ->label(__('Name (Arabic)'))
                            ->required(),
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->label(__('Order'))
                            ->default(0)
                            ->required(),
                        Forms\Components\Select::make('parent_id')
                            ->label(__('Parent Category'))
                            ->options(function () {
                                return ProductCategory::whereNull('parent_id')
                                    ->orderBy('order')
                                    ->get()
                                    ->mapWithKeys(function ($category) {
                                        $name = $category->name[app()->getLocale()] ?? $category->name['en'] ?? '';
                                        return [$category->id => $name];
                                    });
                            })
                            ->searchable()
                            ->preload()
                            ->placeholder(__('Select a parent category'))
                            ->nullable(),

                        Forms\Components\Textarea::make('description')
                            ->label(__('Description'))
                            ->rows(5)
                            ->columnSpanFull(),
                    ])->columns(2),

                // Repeatable form for sub-categories (only for parent categories)
                Forms\Components\Section::make(__('Sub Categories'))
                    ->schema([
                        Forms\Components\Repeater::make('subCategories')
                            ->relationship('subCategories')
                            ->label(__('Sub Categories'))
                            ->schema([
                                Forms\Components\TextInput::make('name.en')
                                    ->label(__('Name (English)'))
                                    ->required(),
                                Forms\Components\TextInput::make('name.ar')
                                    ->label(__('Name (Arabic)'))
                                    ->required(),
                            ])
                            ->columns(2)
                            ->collapsed()
                            ->addActionLabel(__('Add Sub Category'))
                            ->reorderable('order')
                            ->orderColumn('order')
                            ->itemLabel(function (array $state): ?string {
                                return $state['name'][app()->getLocale()] ?? $state['name']['en'] ?? null;
                            })
                    ])
                    ->collapsible()
                    ->collapsed(fn($record) => $record === null)
                    ->visible(fn($record) => $record === null || $record->parent_id === null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'asc')
            ->reorderable('order')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->formatStateUsing(function ($record) {
                        return $record->name[app()->getLocale()] ?? $record->name['en'] ?? '';
                    })
                    ->searchable()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('parent.name')
                //     ->label(__('Parent Category'))
                //     ->formatStateUsing(function ($record) {
                //         if ($record->parent_id === null) {
                //             return __('Main Category');
                //         }
                //         return $record->parent?->name[app()->getLocale()] ?? $record->parent?->name['en'] ?? __('No parent category');
                //     }),
                Tables\Columns\TextColumn::make('children_count')
                    ->label(__('Sub Categories'))
                    ->counts('children')
                    ->badge()
                    ->color('warning'),
                Tables\Columns\TextColumn::make('order')
                    ->label(__('Order'))
                    ->sortable(),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                // By default, only show main categories (those without parent)
                return $query->withCount('children')->whereNull('parent_id');
            })
            ->headerActions([
                //
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
