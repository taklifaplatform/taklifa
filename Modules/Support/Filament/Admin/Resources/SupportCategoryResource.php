<?php

namespace Modules\Support\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Modules\Support\Entities\SupportCategory;
use Modules\Support\Filament\Admin\Resources\SupportCategoryResource\Pages;

class SupportCategoryResource extends Resource
{
    protected static ?string $model = SupportCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__(''))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name.en')
                            ->autofocus()
                            ->required()
                            ->label(__('Name (English)')),

                        Forms\Components\TextInput::make('name.ar')
                            ->autofocus()
                            ->required()
                            ->label(__('Name (Arabic)')),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSupportCategories::route('/'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('Support Category');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Support Categories');
    }

    public static function getNavigationGroup(): string
    {
        return __('Supports');
    }
}
