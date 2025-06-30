<?php

namespace Modules\Support\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Modules\Support\Entities\Support;
use Modules\Support\Filament\Admin\Resources\SupportResource\Pages;

class SupportResource extends Resource
{
    protected static ?string $model = Support::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Support Information'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->searchable()
                            ->required()
                            ->preload()
                            ->relationship('category', 'name')
                            ->label(__('Category')),

                        Forms\Components\Select::make('user_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('user', 'username')
                            ->label(__('User')),

                        Forms\Components\TextInput::make('email')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->email()
                            ->label(__('Email')),

                        Forms\Components\TextInput::make('phone_number')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->label(__('Phone Number')),

                        Forms\Components\Select::make('status')
                            ->label(__('Status'))
                            ->options([
                                'pending' => 'Pending',
                                'resolved' => 'Resolved',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('subject')
                            ->required()
                            ->label(__('Subject')),

                        MarkdownEditor::make('message')
                            ->required()
                            ->label(__('Message')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->label(__('Category'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('User'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email'))
                    ->icon('heroicon-m-envelope')
                    ->iconColor('primary')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone_number')
                    ->label(__('Phone Number'))
                    ->icon('heroicon-o-phone')
                    ->iconColor('primary')
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject')
                    ->label(__('Subject'))
                    ->limit(50)
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(function ($state) {
                        return ucwords(str_replace('_', ' ', $state));
                    })
                    ->badge()
                    ->color(function ($record): string|null {
                        if ($record->status === 'pending') {
                            return 'primary';
                        }

                        if ($record->status === 'resolved') {
                            return 'success';
                        }

                        return null;
                    })
                    ->label(__('Status'))
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListSupports::route('/'),
            'create' => Pages\CreateSupport::route('/create'),
            'edit' => Pages\EditSupport::route('/{record}/edit'),
            'view' => Pages\ViewSupport::route('/{record}'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('Support');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Supports');
    }

    public static function getNavigationGroup(): string
    {
        return __('Supports');
    }
}
