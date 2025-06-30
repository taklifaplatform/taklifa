<?php

namespace Modules\User\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Spatie\Permission\Models\Role;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Modules\User\Filament\Admin\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make((__('User Information')))
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->collection('avatar')
                            ->label(__('Avatar'))
                            ->image()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('username')
                            ->required()
                            ->label(__('Username')),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->label(__('Name')),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->label(__('Email'))
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('phone_number')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->label(__('Phone Number'))
                            ->unique(ignoreRecord: true),

                        Forms\Components\MarkdownEditor::make('about')
                            ->columnSpanFull()
                            ->label(__('About')),

                    ])->columns(2),

                Forms\Components\Section::make(__('Secure Information'))
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->required()->visibleOn(['create'])
                            ->label(__('Password')),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->password()
                            ->revealable()
                            ->required()->visibleOn(['create'])
                            ->label(__('Password Confirmation')),
                    ])->columns(2),

                Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\Select::make('roles')->label(__('Roles'))
                            ->options(Role::pluck('name', 'id'))
                            ->multiple()
                            ->searchable()
                            ->relationship('roles', 'name')
                            ->preload()
                            ->columnSpan(2),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // ID
                Tables\Columns\TextColumn::make('id')
                    ->label(__('ID'))
                    ->limit(8)
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                // Phone Number
                Tables\Columns\TextColumn::make('phone_number')
                    ->label(__('Phone'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),


                Tables\Columns\TextColumn::make('roles.name')
                    ->listWithLineBreaks()
                    ->label(__('Accounts'))
                    ->badge()
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        return ucwords(str_replace('_', ' ', $state));
                    }),

                // is verified
                Tables\Columns\IconColumn::make('verification.is_verified')
                    ->label(__('Verification Status'))
                    ->boolean(),

                Tables\Columns\ToggleColumn::make('urgency_service_provider')
                    ->label(__('Urgency Service Provider')),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created'))
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ActionGroup::make([
                //     Tables\Actions\ViewAction::make(),
                //     Tables\Actions\EditAction::make(),
                //     Tables\Actions\DeleteAction::make(),
                // ]),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}/view'),
        ];
    }

    public static function getLabel(): ?string
    {
        return __('User');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Users');
    }

    public static function getNavigationGroup(): string
    {
        return __('filament-shield::filament-shield.nav.group');
    }
}
