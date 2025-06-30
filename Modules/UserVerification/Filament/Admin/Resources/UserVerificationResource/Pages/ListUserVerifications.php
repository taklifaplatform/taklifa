<?php

namespace Modules\UserVerification\Filament\Admin\Resources\UserVerificationResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\UserVerification\Filament\Admin\Resources\UserVerificationResource;

class ListUserVerifications extends ListRecords
{
    protected static string $resource = UserVerificationResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
