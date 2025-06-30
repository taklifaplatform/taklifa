<?php

namespace Modules\UserVerification\Filament\Admin\Resources\UserVerificationResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\UserVerification\Filament\Admin\Resources\UserVerificationResource;

class EditUserVerification extends EditRecord
{
    protected static string $resource = UserVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\Action::make('verify_user')
                ->label('Verify User')
                ->requiresConfirmation()
                ->visible(fn ($record) => !$record->is_verified)
                ->action(function (Actions\Action $action) {
                    $record = $action->getRecord();
                    $record->verify();
                }),
        ];
    }
}
