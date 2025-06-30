<?php

namespace Modules\UserVerification\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Modules\UserVerification\Entities\UserVerification;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Modules\UserVerification\Filament\Admin\Resources\UserVerificationResource\Pages;

class UserVerificationResource extends Resource
{
    protected static ?string $model = UserVerification::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Basic Information'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'username')
                            ->label(__('User'))
                            ->preload()
                            ->searchable()
                            ->required(),

                        Forms\Components\DatePicker::make('birth_date')
                            ->required()
                            ->label(__('Birth Date')),

                        Forms\Components\Select::make('nationality_id')
                            ->label(__('Nationality'))
                            ->relationship('nationality', 'name')
                            ->preload()
                            ->searchable(),

                        Forms\Components\Select::make('verification_status')
                            ->label(__('Verification Status'))
                            ->options([
                                UserVerification::VERIFICATION_STATUS_PENDING => 'Pending',
                                UserVerification::VERIFICATION_STATUS_IN_REVIEW => 'In Review',
                                UserVerification::VERIFICATION_STATUS_VERIFIED => 'Verified',
                                UserVerification::VERIFICATION_STATUS_REJECTED => 'Rejected',
                            ]),

                        Forms\Components\Select::make('verified_by')
                            ->label(__('Verified By'))
                            ->relationship('verifiedBy', 'username')
                            ->preload()
                            ->searchable(),

                        Forms\Components\DatePicker::make('verified_at')
                            ->label(__('Verified At')),

                        SpatieMediaLibraryFileUpload::make('identity_card')
                            ->collection('identity_card')
                            ->columnSpanFull()
                            ->conversion('preview')
                            ->image()
                            ->label(__('Identity Card')),

                        Forms\Components\Toggle::make('is_verified')
                            ->label(__('Is Verified'))
                    ]),
                Forms\Components\Section::make(__('Driver License & Insurance'))
                    ->schema([
                        Forms\Components\TextInput::make('driving_license_number')
                            ->required()
                            ->label(__('Driving License Number')),

                        SpatieMediaLibraryFileUpload::make('driving_license_card')
                            ->collection('driving_license_card')
                            ->label(__('Driver License')),

                        SpatieMediaLibraryFileUpload::make('assurance_card')
                            ->collection('assurance_card')
                            ->label(__('Insurance Card')),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('User'))
                    ->badge()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.phone_number')
                    ->label(__('Phone Number'))
                    ->badge()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.roles.name')
                    ->label(__('Roles'))
                    ->formatStateUsing(function ($state) {
                        return ucwords(str_replace('_', ' ', $state));
                    })
                    ->listWithLineBreaks()
                    ->badge(),

                Tables\Columns\TextColumn::make('user.name')
                    ->sortable()
                    ->searchable()
                    ->label(__('Name')),

                Tables\Columns\TextColumn::make('birth_date')
                    ->label(__('Birth Date'))
                    ->date('Y-m-d'),

                Tables\Columns\TextColumn::make('nationality.name')
                    ->label(__('Nationality'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('verified_at')
                    ->label(__('Verified At'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('verifiedBy.name')
                    ->label(__('Verified By'))
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('verification_status')
                    ->label(__('Verification Status'))
                    ->badge()
                    ->color(fn($record) => match ($record->verification_status) {
                        UserVerification::VERIFICATION_STATUS_PENDING => 'warning',
                        UserVerification::VERIFICATION_STATUS_IN_REVIEW => 'info',
                        UserVerification::VERIFICATION_STATUS_VERIFIED => 'success',
                        UserVerification::VERIFICATION_STATUS_REJECTED => 'danger',
                    })
                    ->formatStateUsing(function ($state) {
                        return ucwords(str_replace('_', ' ', $state));
                    }),


                Tables\Columns\TextColumn::make('vehicles_count')
                    ->counts('vehicles')
                    ->label(__('Vehicles'))
                    ->badge(),

            ])
            ->filters([
                // filter only that has vehicles count greater than 0 or 0
                Tables\Filters\TernaryFilter::make('vehicles')
                    ->queries(
                        true: fn(Builder $query) => $query->whereHas('vehicles'),
                        false: fn(Builder $query) => $query->whereDoesntHave('vehicles'),
                    ),
            ])
            ->actions([
                Tables\Actions\Action::make('verify_user')
                    ->label('Verify User')
                    ->requiresConfirmation()
                    ->visible(fn($record) => !$record->is_verified)
                    ->action(function (Tables\Actions\Action $action) {
                        $record = $action->getRecord();
                        $record->verify();
                    }),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\ExportBulkAction::make()
                    ->exporter(\App\Filament\Exports\UserVerificationExporter::class),
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
            'index' => Pages\ListUserVerifications::route('/'),
            'edit' => Pages\EditUserVerification::route('/{record}/edit'),
            'view' => Pages\ViewUserVerification::route('/{record}'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('User Verification');
    }

    public static function getPluralLabel(): ?string
    {
        return __('User Verifications');
    }

    public static function getNavigationGroup(): string
    {
        return __('filament-shield::filament-shield.nav.group');
    }
}
