<?php

namespace Modules\Shipment\Filament\Admin\Resources\ShipmentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ShipmentInvitationsRelationManager extends RelationManager
{
    protected static string $relationship = 'invitations';

    protected static ?string $title = 'Shipment Invitations';

    protected static ?string $label = 'Shipment Invitation';

    protected static ?string $inverseRelationship = 'shipment';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->modelLabel(__('Shipment Invitation'))
            ->heading(__('Shipment Invitations'))
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'accepted' => 'success',
                        'declined' => 'danger',
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
        return __('Shipment Invitation');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Shipment Invitations');
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Shipment Invitations');
    }
}
