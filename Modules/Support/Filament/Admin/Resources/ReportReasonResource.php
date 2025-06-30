<?php

namespace Modules\Support\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Modules\Support\Entities\ReportReason;
use Modules\Support\Filament\Admin\Resources\ReportReasonResource\Pages;

class ReportReasonResource extends Resource
{
    protected static ?string $model = ReportReason::class;

    protected static ?string $navigationIcon = 'heroicon-s-cog-6-tooth';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__(''))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name.en')
                            ->required()
                            ->label(__('Name (English)')),

                        Forms\Components\TextInput::make('name.ar')
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
            'index' => Pages\ListReportReasons::route('/')
        ];
    }

    public static function getLabel(): ?string
    {
        return __('Report Reason');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Report Reasons');
    }

    public static function getNavigationGroup(): string
    {
        return __('Supports');
    }
}
