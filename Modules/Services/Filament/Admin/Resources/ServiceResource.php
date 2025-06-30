<?php

namespace Modules\Services\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Modules\Services\Entities\Service;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Modules\Services\Filament\Admin\Resources\ServiceResource\Pages;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Company Information'))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('cover')
                            ->collection('cover')
                            ->label(__('Cover'))
                            ->conversion('preview')
                            ->image()
                            ->columnSpanFull(),

                        SpatieMediaLibraryFileUpload::make('images')
                            ->collection('images')
                            ->label(__('Images'))
                            ->conversion('preview')
                            ->image()
                            ->multiple()
                            ->columnSpanFull(),

                        Forms\Components\Select::make('company_id')
                            ->relationship('company', 'name')
                            ->label(__('Company'))
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('driver_id')
                            ->relationship('driver', 'username')
                            ->label(__('Driver'))
                            ->searchable()
                            ->preload(),

                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->label(__('Title')),

                        MarkdownEditor::make('description')
                            ->columnSpanFull()
                            ->label(__('Description')),

                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company.name')
                    ->label(__('Company'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('driver.username')
                    ->formatStateUsing(function ($record) {
                        return Str::title($record->driver->username);
                    })
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->label(__('User')),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
            'view' => Pages\ViewService::route('/{record}'),
        ];
    }


    public static function getLabel(): ?string
    {
        return __('Service');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Services');
    }

    public static function getNavigationGroup(): string
    {
        return __('Services');
    }
}
