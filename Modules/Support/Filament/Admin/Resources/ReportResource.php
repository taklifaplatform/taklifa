<?php

namespace Modules\Support\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Modules\Support\Entities\Report;
use Modules\Support\Filament\Admin\Resources\ReportResource\Pages;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-command-line';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Report Information'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label(__('User'))
                            ->required()
                            ->relationship('user', 'username')
                            ->preload()
                            ->searchable(),

                        Forms\Components\Select::make('reason_id')
                            ->required()
                            ->preload()
                            ->label(__('Reason'))
                            ->relationship('reason', 'name')
                            ->searchable(),

                        Forms\Components\Select::make('status')
                            ->label(__('Status'))
                            ->required()
                            ->options([
                                'pending' => 'Pending',
                                'resolved' => 'Resolved',
                            ]),

                        Forms\Components\MarkdownEditor::make('message')
                            ->label(__('Message'))
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\Hidden::make('reportable_id')
                            ->default(auth()->id()),

                        Forms\Components\Hidden::make('reportable_type')
                            ->default(get_class(auth()->user())),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('User'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('reason.name')
                    ->label(__('Reason'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('message')
                    ->label(__('Message'))
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
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
            'view' => Pages\ViewReport::route('/{record}'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('Report');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Reports');
    }

    public static function getNavigationGroup(): string
    {
        return __('Supports');
    }
}
