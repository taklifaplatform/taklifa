<?php

namespace Modules\Geography\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Modules\Geography\Entities\State;
use Modules\Geography\Filament\Admin\Resources\StateResource\Pages;

class StateResource extends Resource
{
    protected static ?string $model = State::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title.en')
                    ->label(__('Name (English)'))
                    ->required(),
                Forms\Components\TextInput::make('title.ar')
                    ->label(__('Name (Arabic)'))
                    ->required(),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->label(__('Code')),
                Forms\Components\TextInput::make('postal')
                    ->label(__('Postal')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->label(__('Name')),
                Tables\Columns\TextColumn::make('code')
                    ->label(__('Code')),
                Tables\Columns\TextColumn::make('postal')
                    ->label(__('Postal')),
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
            'index' => Pages\ListStates::route('/'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Geography');
    }

    public static function getLabel(): ?string
    {
        return __('State');
    }

    public static function getPluralLabel(): ?string
    {
        return __('States');
    }
}
