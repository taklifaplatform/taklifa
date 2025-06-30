<?php

namespace Modules\Announcements\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Announcements\Entities\AnnouncementCategory;
use Modules\Announcements\Filament\Admin\Resources\AnnouncementCategoryResource\Pages;
use Modules\Announcements\Filament\Admin\Resources\AnnouncementCategoryResource\RelationManagers;

class AnnouncementCategoryResource extends Resource
{
    protected static ?string $model = AnnouncementCategory::class;

    protected static ?string $navigationIcon = 'heroicon-c-megaphone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name.en')
                            ->label(__('Name (English)'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('name.ar')
                            ->label(__('Name (Arabic)'))
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('description.en')
                            ->label(__('Description (English)'))
                            ->maxLength(65535),

                        Forms\Components\Textarea::make('description.ar')
                            ->label(__('Description (Arabic)'))
                            ->maxLength(65535),

                        Forms\Components\Select::make('parent_id')
                            ->label(__('Parent Category'))
                            ->relationship('parent', 'name->en', function (Builder $query) {
                                return $query->whereNull('parent_id');
                            })
                            ->searchable()
                            ->preload(),

                        Forms\Components\Toggle::make('enabled')
                            ->label(__('Enabled'))
                            ->default(true),

                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->required()
                            ->label(__('Order')),

                        Forms\Components\Repeater::make('metadata_fields')
                            ->label(__('Metadata Fields'))
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('identifier')
                                    ->label(__('Identifier'))
                                    ->helperText(__('The key is used to identify the field in the metadata array. It must be unique and cannot be changed later.'))
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('name_ar')
                                    ->label(__('Name (Arabic)'))
                                    ->required(),

                                Forms\Components\TextInput::make('name_en')
                                    ->label(__('Name (English)'))
                                    ->required(),

                                Forms\Components\TextInput::make('placeholder_ar')
                                    ->label(__('Placeholder (Arabic)'))
                                    ->required(),

                                Forms\Components\TextInput::make('placeholder_en')
                                    ->label(__('Placeholder (English)'))
                                    ->required(),

                                Forms\Components\Select::make('type')
                                    ->label(__('Type'))
                                    ->options([
                                        'text' => __('Text'),
                                        'number' => __('Number'),
                                        'boolean' => __('Boolean'),
                                    ])
                                    ->required(),
                            ])->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'asc')
            ->defaultPaginationPageOption(50)
            ->reorderable('order')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name')),

                Tables\Columns\TextColumn::make('parent.name')
                    ->label(__('Parent Category'))
                    ->badge(),

                Tables\Columns\ToggleColumn::make('enabled')
                    ->label(__('Enabled')),

                Tables\Columns\TextColumn::make('order')
                    ->numeric()
                    ->label(__('Order')),
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
                Tables\Actions\EditAction::make(),
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
                    ->url(fn() => route('filament.admin.resources.announcement-categories.index'))
                    ->badge()
                    ->color(request()->query('parent_id') ? 'gray' : 'primary'),
                ...static::getParentCategories()->map(function ($category) {
                    $isActive = request()->query('parent_id') == $category->id;
                    return Tables\Actions\Action::make($category->id)
                        ->label($category->getTranslation('name', app()->getLocale()))
                        ->url(fn() => route('filament.admin.resources.announcement-categories.index', ['parent_id' => $category->id]))
                        ->badge()
                        ->color($isActive ? 'primary' : 'gray');
                })->toArray(),
            ]);
    }

    protected static function getParentCategories()
    {
        return AnnouncementCategory::whereNull('parent_id')->orderBy('order', 'asc')->get();
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
            'index' => Pages\ListAnnouncementCategories::route('/'),
            'create' => Pages\CreateAnnouncementCategory::route('/create'),
            'edit' => Pages\EditAnnouncementCategory::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('Announcement Category');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Announcement Categories');
    }

    public static function getNavigationGroup(): string
    {
        return __('Announcements');
    }
}
