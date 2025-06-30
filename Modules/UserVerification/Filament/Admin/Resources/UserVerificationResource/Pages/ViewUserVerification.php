<?php

namespace Modules\UserVerification\Filament\Admin\Resources\UserVerificationResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Modules\User\Filament\Admin\Resources\UserResource;
use Modules\UserVerification\Entities\UserVerification;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Modules\UserVerification\Filament\Admin\Resources\UserVerificationResource;

class ViewUserVerification extends ViewRecord
{
    protected static string $resource = UserVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        return $this->getRecord()?->name ?? 'View User Verification';
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make(__('User Verification Information'))
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(6)
                                ->schema([
                                    Components\Group::make([
                                        Components\SpatieMediaLibraryImageEntry::make('identity_card')
                                        ->collection('identity_card')
                                        ->label(__('Identity Card'))
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('user.username')
                                            ->label(__('User Name'))
                                            ->visible(fn($record) => $record->user)
                                            ->url(function ($record) {
                                                return UserResource::getUrl('view', ['record' => $record->user]);
                                            })
                                            ->size(TextEntrySize::Medium),

                                        Components\TextEntry::make('user.roles.name')
                                            ->label(__('Role'))
                                            ->badge()
                                            ->formatStateUsing(function ($state) {
                                                return ucwords(str_replace('_', ' ', $state));
                                            })
                                            ->listWithLineBreaks()
                                            ->size(TextEntrySize::Medium),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('name')
                                            ->label(__('Name'))
                                            ->size(TextEntrySize::Medium),

                                        Components\TextEntry::make('birth_date')
                                            ->label(__('Birth Date'))
                                            ->date()
                                            ->size(TextEntrySize::Medium),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('nationality.name')
                                            ->label(__('Nationality')),

                                        Components\TextEntry::make('verification_status')
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
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('verifiedBy.name')
                                            ->label(__('Verified By'))
                                            ->url(function ($record) {
                                                return $record->verifiedBy
                                                    ? UserResource::getUrl('view', ['record' => $record->verifiedBy])
                                                    : null;
                                            }),

                                        Components\TextEntry::make('verified_at')
                                            ->label(__('Verified At'))
                                            ->dateTime()
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

                Components\Section::make(__('Driver License & Insurance'))
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(3)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('driving_license_number')
                                            ->label(__('Driving license number'))
                                            ->size(TextEntrySize::Medium),
                                    ]),

                                    Components\Group::make([
                                        Components\SpatieMediaLibraryImageEntry::make('driving_license_card')
                                            ->collection('driving_license_card')
                                            ->label(__('Driver License')),
                                    ]),

                                    Components\Group::make([
                                        Components\SpatieMediaLibraryImageEntry::make('assurance_card')
                                            ->collection('assurance_card')
                                            ->label(__('Insurance Card')),
                                    ]),
                                ]),

                        ])->from('lg'),
                    ]),
            ]);
    }
}
