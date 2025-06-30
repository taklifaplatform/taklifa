<?php

namespace Modules\Company\Filament\Admin\Resources\CompanyResource\RelationManagers;

use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\RelationManagers\RelationManager;

class CompanyManagersRelationManager extends RelationManager
{
    protected static string $relationship = 'managers';

    protected static ?string $inverseRelationship = 'company';

    protected static ?string $title = 'Company Managers';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('username')
                    ->searchable()
                    ->sortable()
                    ->label(__('Username')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(__('Name')),
                Tables\Columns\TextColumn::make('phone_number')
                    ->icon('heroicon-m-phone')
                    ->label(__('Phone Number')),
                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->label(__('Email')),
                Tables\Columns\TextColumn::make('latest_activity')
                    ->label(__('Latest Activity'))
                    ->dateTime()
                    ->badge(),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->formatStateUsing(function ($record) {
                        return Str::title($record->status);
                    })
                    ->color(function ($record) {
                        if ($record->status === 'online') {
                            return 'success';
                        } elseif ($record->status === 'busy') {
                            return 'danger';
                        } elseif ($record->status === 'offline') {
                            return 'gray';
                        }
                    }),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getLabel(): ?string
    {
        return __('Company Managers');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Company Managers');
    }

    protected static function getModelLabel(): string
    {
        return __('Company Manager');
    }

    public static function getTitle(Model $model, string $pageClass): string
    {
        return __('Company Managers');
    }
}
