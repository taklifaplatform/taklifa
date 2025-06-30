<?php

namespace Modules\Company\Filament\Admin\Resources\CompanyResource\Pages;

use Filament\Actions;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use Modules\User\Filament\Admin\Resources\UserResource;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Modules\Company\Filament\Admin\Resources\CompanyResource;

class ViewCompany extends ViewRecord
{
    protected static string $resource = CompanyResource::class;

    public function getTitle(): string | Htmlable
    {
        return $this->getRecord()?->name ?? __('View Company');
    }


    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
            Actions\Action::make('verify_company')
                ->label(__('Verify Company'))
                ->requiresConfirmation()
                ->visible(fn($record) => !$record->is_verified)
                ->action(function (Actions\Action $action) {
                    $record = $action->getRecord();
                    $record->verify();
                }),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make(__('Company Details'))
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(3)
                                ->schema([
                                    Components\Group::make([
                                        Components\SpatieMediaLibraryImageEntry::make('logo')
                                            ->label(__('Logo'))
                                            ->collection('logo')
                                            ->size(80)
                                            ->circular(),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('name')
                                            ->label(__('Name'))
                                            ->size(TextEntrySize::Medium),
                                        Components\TextEntry::make('owner.username')
                                            ->label(__('Owner'))
                                            ->size(TextEntrySize::Medium)
                                            ->visible(fn ($record) => $record->owner)
                                            ->url(function ($record) {
                                                return UserResource::getUrl('view', ['record' => $record->owner]);
                                            }),
                                    ]),

                                    Components\Group::make([
                                        Components\TextEntry::make('verifiedBy.name')
                                            ->label(__('Verified By'))
                                            ->badge()
                                            ->visible(fn ($record) => $record->verifiedBy)
                                            ->url(function ($record) {
                                                return UserResource::getUrl('view', ['record' => $record->verifiedBy]);
                                            }),
                                        Components\TextEntry::make('verified_at')
                                            ->label(__('Verified At'))
                                            ->date()
                                            ->color('success')
                                            ->badge(),
                                    ]),
                                ]),

                        ])->from('lg'),
                    ]),
            ]);
    }
}
