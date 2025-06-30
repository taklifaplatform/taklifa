<?php

namespace Modules\Core\Filament\Admin\Resources;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Modules\Core\Entities\Modules;
use Nwidart\Modules\Facades\Module;
use Filament\Tables\Actions\Action;
use Modules\Core\Filament\Admin\Resources\ModulesManagerResource\Pages;

class ModulesManagerResource extends Resource
{
    protected static ?string $model = Modules::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Module Name')),
                Tables\Columns\TextColumn::make('priority')
                    ->label(__('Priority')),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('Description')),

                Tables\Columns\TextColumn::make('version')
                    ->label(__('Version')),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'danger' => static fn ($state): bool => $state == 'disabled',
                        'success' => static fn ($state): bool => $state == 'enabled',
                    ])
                    ->label(__('Status')),
            ])
            ->actions([
                Action::make('enable')
                    ->requiresConfirmation()
                    ->color('success')->button()
                    ->disabled(static fn (Modules $modules): bool => ! $modules->can_disabled)
                    ->hidden(static fn (Modules $modules): bool => $modules->enabled == true)
                    ->action(function (Modules $modules) {
                        Module::find($modules->identifier)->enable();

                        return redirect()->back();
                    })
                    ->label(__('Enable')),
                Action::make('disable')
                    ->requiresConfirmation()
                    ->color('danger')->button()
                    ->disabled(static fn (Modules $modules): bool => ! $modules->can_disabled)
                    ->hidden(static fn (Modules $modules): bool => $modules->enabled == false || ! $modules->priority > 0)

                    ->action(function (Modules $modules) {
                        Module::find($modules->identifier)->disable();

                        return redirect()->back();
                    })
                    ->label(__('Disable')),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListModulesManagers::route('/'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('Module');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Modules');
    }

    public static function getNavigationGroup(): string
    {
        return __('Settings');
    }
}
