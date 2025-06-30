<?php

namespace Modules\Notification\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Notification\Entities\NotificationTemplate;
use Modules\Notification\Filament\Admin\Resources\NotificationTemplateResource\Pages;

class NotificationTemplateResource extends Resource
{
    protected static ?string $model = NotificationTemplate::class;

    protected static ?string $navigationIcon = 'heroicon-s-bell-alert';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make(__('Notification Type'))
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->options(NotificationTemplate::TYPES)
                            ->unique(ignoreRecord: true)
                            ->label(__('Type'))
                            ->required(),
                    ]),

                Forms\Components\Section::make(__('User Settings Notification'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('settings_title.en')
                            ->label(__('Settings Title (English)')),
                        Forms\Components\TextInput::make('settings_title.ar')
                            ->label(__('Settings Title (Arabic)')),

                        Forms\Components\Toggle::make('has_settings')
                            ->label(__('Has Settings'))
                            ->required(),
                    ])->collapsible(),

                Forms\Components\Section::make(__('SMS Notification'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('sms_notification_title.en')
                            ->label(__('SMS Notification Title (English)')),
                        Forms\Components\TextInput::make('sms_notification_title.ar')
                            ->label(__('SMS Notification Title (Arabic)')),

                        Forms\Components\Textarea::make('sms_notification_description.en')
                            ->label(__('SMS Notification Description (English)'))
                            ->rows(5),
                        Forms\Components\Textarea::make('sms_notification_description.ar')
                            ->label(__('SMS Notification Description (Arabic)'))
                            ->rows(5),

                        Forms\Components\Toggle::make('sms_notification')
                            ->label(__('SMS Notification'))
                            ->required(),
                    ])->collapsible(),

                Forms\Components\Section::make(__('Push Notification'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('push_notification_title.en')
                            ->label(__('Push Notification Title (English)')),

                        Forms\Components\TextInput::make('push_notification_title.ar')
                            ->label(__('Push Notification Title (Arabic)')),

                        Forms\Components\Textarea::make('push_notification_description.en')
                            ->label(__('Push Notification Description (English)'))
                            ->rows(5),
                        Forms\Components\Textarea::make('push_notification_description.ar')
                            ->label(__('Push Notification Description (Arabic)'))
                            ->rows(5),

                        Forms\Components\Toggle::make('push_notification')
                            ->label(__('Push Notification'))
                            ->required(),
                    ])->collapsible(),

                Forms\Components\Section::make(__('Email Notification'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('email_notification_title.en')
                            ->label(__('Email Notification Title (English)')),
                        Forms\Components\TextInput::make('email_notification_title.ar')
                            ->label(__('Email Notification Title (Arabic)')),

                        Forms\Components\Textarea::make('email_notification_description.en')
                            ->label(__('Email Notification Description (English)'))
                            ->rows(5),
                        Forms\Components\Textarea::make('email_notification_description.ar')
                            ->label(__('Email Notification Description (Arabic)'))
                            ->rows(5),

                        Forms\Components\Toggle::make('email_notification')
                            ->label(__('Email Notification'))
                            ->required(),
                    ])->collapsible(),

                Forms\Components\Section::make(__('Database Notification (In-App)'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('db_notification_title.en')
                            ->label(__('In-App Notification Title (English)')),
                        Forms\Components\TextInput::make('db_notification_title.ar')
                            ->label(__('In-App Notification Title (Arabic)')),

                        Forms\Components\Textarea::make('db_notification_description.en')
                            ->label(__('In-App Notification Description (English)'))
                            ->rows(5),
                        Forms\Components\Textarea::make('db_notification_description.ar')
                            ->label(__('In-App Notification Description (Arabic)'))
                            ->rows(5),

                        Forms\Components\Toggle::make('db_notification')
                            ->label(__('In-App Notification'))
                            ->required(),
                    ])->collapsible(),

                Forms\Components\Section::make(__('Icon Settings'))
                    ->schema([
                        Forms\Components\TextInput::make('icon')
                            ->label(__('Icon')),
                        Forms\Components\Toggle::make('icon_user_avatar')
                            ->label(__('Icon User Avatar'))
                            ->required(),
                        Forms\Components\Toggle::make('icon_rounded')
                            ->label(__('Icon Rounded'))
                            ->required(),
                        Forms\Components\ColorPicker::make('icon_background_color')
                            ->label(__('Icon Background Color')),
                    ]),

                Forms\Components\Toggle::make('enabled')
                    ->label(__('Enabled'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label(__('Type'))
                    ->formatStateUsing(function ($record) {
                        try {
                            return NotificationTemplate::TYPES[$record->type];
                        } catch (\Throwable $th) {
                            return $record->type;
                        }
                    })
                    ->searchable(),
                Tables\Columns\IconColumn::make('enabled')
                    ->label(__('Enabled'))
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('icon_user_avatar')
                    ->label(__('Icon User Avatar'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('icon_rounded')
                    ->label(__('Icon Rounded'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('email_notification')
                    ->label(__('Email Notification'))
                    ->boolean(),
                Tables\Columns\IconColumn::make('db_notification')
                    ->label(__('In-App Notification'))
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('Updated At'))
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\TextColumn::make('deleted_at')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('Deleted At'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListNotificationTemplates::route('/'),
            'create' => Pages\CreateNotificationTemplate::route('/create'),
            'edit' => Pages\EditNotificationTemplate::route('/{record}/edit'),
            'view' => Pages\ViewNotificationTemplate::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Notifications');
    }

    public static function getLabel(): ?string
    {
        return __('Notification Template');
    }

    public static function getPluralLabel(): ?string
    {
        return __('Notification Templates');
    }
}
