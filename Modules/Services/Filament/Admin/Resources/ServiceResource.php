<?php

namespace Modules\Services\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Modules\Services\Entities\Service;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\User\Filament\Admin\Resources\UserResource;
use Modules\Services\Entities\ServiceCategory;
use Modules\Services\Filament\Admin\Resources\ServiceResource\Pages;
use Modules\Services\Filament\Admin\Resources\ServiceResource\RelationManagers;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

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
                Tables\Columns\TextColumn::make('user.username')->badge()->url(
                    fn(Service $record) =>
                    UserResource::getUrl('view', ['record' => $record->user_id])
                )
                ->label(__('User')),
                Tables\Columns\TextColumn::make('category.name')->badge()->label(__('Category')),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label(__('Title')),
                Tables\Columns\TextColumn::make('price')
                    ->sortable()
                    ->label(__('Price')),
                Tables\Columns\TextColumn::make('city')
                    ->searchable()
                    ->label(__('City')),
                Tables\Columns\TextColumn::make('views_count')
                    ->counts('views')
                    ->label(__('Views'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('calls_count')
                    ->counts('calls')
                    ->label(__('Calls'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->label(__('Created At')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->options(ServiceCategory::where('parent_id', null)->pluck('name', 'id'))
                    ->label(__('Category')),
            ])
            ->actions([
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
            'index' => Pages\ListServices::route('/'),
            // 'create' => Pages\CreateService::route('/create'),
            // 'edit' => Pages\EditService::route('/{record}/edit'),
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
