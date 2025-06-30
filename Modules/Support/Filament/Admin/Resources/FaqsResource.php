<?php

namespace Modules\Support\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Modules\Support\Entities\Faq;
use Filament\Resources\Resource;
use Modules\Support\Filament\Admin\Resources\FaqsResource\Pages;

class FaqsResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('FAQ Information'))
                    ->schema([
                        Forms\Components\TextInput::make('title.en')
                            ->autofocus()
                            ->required()
                            ->label(__('Title (English)')),

                        Forms\Components\TextInput::make('title.ar')
                            ->autofocus()
                            ->required()
                            ->label(__('Title (Arabic)')),


                        Forms\Components\RichEditor::make('content.en')
                            ->label(__('Content (English)')),

                        Forms\Components\RichEditor::make('content.ar')
                            ->label(__('Content (Arabic)')),

                        Forms\Components\TextInput::make('order')
                            ->label(__('Order'))
                            ->numeric()
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order')
                    ->label(__('Order'))
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaqs::route('/create'),
            'edit' => Pages\EditFaqs::route('/{record}/edit'),
            'view' => Pages\ViewFaqs::route('/{record}'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('FAQ');
    }

    public static function getPluralLabel(): ?string
    {
        return __('FAQs');
    }

    public static function getNavigationGroup(): string
    {
        return __('Supports');
    }
}
