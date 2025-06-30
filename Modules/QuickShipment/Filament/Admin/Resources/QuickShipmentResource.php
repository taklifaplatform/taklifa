<?php

namespace Modules\QuickShipment\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Modules\QuickShipment\Entities\QuickShipment;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\QuickShipment\Filament\Admin\Resources\QuickShipmentResource\Pages;
use Modules\QuickShipment\Filament\Admin\Resources\QuickShipmentResource\RelationManagers;

class QuickShipmentResource extends Resource
{
    protected static ?string $model = QuickShipment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('User')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('driver.name')->label('Driver')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('date')->label('Date')->date()->searchable()->sortable(),
                Tables\Columns\TextColumn::make('price')->label('Price')->searchable()->sortable(),
                Tables\Columns\IconColumn::make('is_accepted')->label('Status')->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListQuickShipments::route('/'),
            'create' => Pages\CreateQuickShipment::route('/create'),
            'edit' => Pages\EditQuickShipment::route('/{record}/edit'),
        ];
    }
}
