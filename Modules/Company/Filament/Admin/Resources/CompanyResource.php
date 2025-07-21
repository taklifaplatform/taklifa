<?php

namespace Modules\Company\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Modules\Company\Entities\Company;
use Modules\Geography\Entities\Location;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Modules\Company\Filament\Admin\Resources\CompanyResource\Pages;
use Modules\Company\Filament\Admin\Resources\CompanyResource\RelationManagers\CompanyManagersRelationManager;
use Modules\Company\Filament\Admin\Resources\CompanyResource\RelationManagers\CompanyBranchRelationManager;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-s-building-office-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Company Information'))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('logo')
                            ->collection('logo')
                            ->label(__('Logo'))
                            ->conversion('preview')
                            ->image()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label(__('Name')),

                        Forms\Components\Select::make('owner_id')
                            ->relationship('owner', 'username')
                            ->label(__('Owner'))
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('verification_status')
                            ->options([
                                Company::VERIFICATION_STATUS_PENDING => 'Pending',
                                Company::VERIFICATION_STATUS_IN_REVIEW => 'In Review',
                                Company::VERIFICATION_STATUS_VERIFIED => 'Verified',
                                Company::VERIFICATION_STATUS_REJECTED => 'Rejected',
                            ])
                            ->label(__('Verification Status'))
                            ->required(),

                        DateTimePicker::make('verified_at')
                            ->label(__('Verified At'))
                            ->time(),

                        Forms\Components\Select::make('verified_by')
                            ->relationship('verifiedBy', 'username')
                            ->label(__('Verified By'))
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('location_id')
                            ->options(Location::whereNotNull('address')->pluck('address', 'id'))
                            ->label(__('Location'))
                            ->searchable()
                            ->preload(),

                        MarkdownEditor::make('about')
                            ->columnSpanFull()
                            ->label(__('About')),

                        Forms\Components\Toggle::make('is_verified')
                            ->required()
                            ->label(__('Is Verified')),

                        Forms\Components\Toggle::make('is_enabled')
                            ->required()
                            ->label(__('Is Enabled')),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('logo')
                    ->label(__('Logo'))
                    ->collection('logo')
                    ->width('50px'),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(__('Name')),
                Tables\Columns\TextColumn::make('owner.username')
                    ->label(__('Owner'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('verified_at')
                    ->label(__('Verified At'))
                    ->color('success')
                    ->badge()
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('verifiedBy.name')
                    ->label(__('Verified By'))
                    ->badge()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('verify_company')
                    ->label(__('Verify Company'))
                    ->requiresConfirmation()
                    ->visible(fn($record) => !$record->is_verified)
                    ->action(function (Tables\Actions\Action $action) {
                        $record = $action->getRecord();
                        $record->verify();
                    }),

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
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
            CompanyManagersRelationManager::class,
            CompanyBranchRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'view' => Pages\ViewCompany::route('/{record}'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),

        ];
    }

    public static function getLabel(): ?string
    {
        return __('Company');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Companies');
    }

    public static function getNavigationGroup(): string
    {
        return __('Companies');
    }
}
