<?php

namespace Modules\User\Filament\Admin\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Modules\User\Filament\Admin\Resources\UserResource;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return $this->getRecord()?->name ?? __('View User');
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make(__('User Details'))
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(5)
                                ->schema([
                                    Components\Group::make([
                                        Components\SpatieMediaLibraryImageEntry::make('avatar')
                                            ->label(__(''))
                                            ->collection('avatar')
                                            ->size(80)
                                            ->circular(),

                                        Components\TextEntry::make('name')
                                            ->label(__('Name')),
                                        Components\TextEntry::make('username')
                                            ->label(__('Username')),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('email')
                                            ->label(__('Email')),
                                        Components\TextEntry::make('phone_number')
                                            ->label(__('Phone')),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('roles.name')
                                            ->label(__('Accounts'))
                                            ->listWithLineBreaks()
                                            ->badge()
                                            ->formatStateUsing(function ($state) {
                                                return ucwords(str_replace('_', ' ', $state));
                                            }),

                                        Components\TextEntry::make('status')
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
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('latest_activity')
                                            ->label(__('Latest Activity'))
                                            ->formatStateUsing(fn(User $record): ?string => $record->updated_at?->diffForHumans())
                                            ->dateTime()
                                            ->badge(),

                                        Components\TextEntry::make('email_verified_at')
                                            ->label(__('Email Verified At'))
                                            ->dateTime()
                                            ->color('success')
                                            ->badge(),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('created_at')
                                            ->label(__('Created at'))
                                            ->badge()
                                            ->dateTime()
                                            ->color('success'),
                                        Components\TextEntry::make('updated_at')
                                            ->label(__('Updated at'))
                                            ->dateTime()
                                            ->badge(),
                                    ]),
                                ]),

                        ])->from('lg'),
                    ]),

                Components\Section::make(heading: (__('About')))
                    ->schema([
                        Components\TextEntry::make('about')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),

                Components\Section::make(heading: (__('Latest Location')))
                    ->schema([
                        Components\TextEntry::make('latestLocation.latitude')
                            ->label(__('Latitude')),
                        Components\TextEntry::make('latestLocation.longitude')
                            ->label(__('Longitude')),

                        // mapview
                    ])
                    ->collapsible(),

                Components\Section::make(heading: (__('Location')))
                    ->schema([
                        Components\TextEntry::make('location.latitude')
                            ->label(__('Latitude')),
                        Components\TextEntry::make('location.longitude')
                            ->label(__('Longitude')),

                        // mapview
                    ])
                    ->collapsible(),

            ]);
    }
}
