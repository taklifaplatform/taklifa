<?php

namespace Modules\Services\Filament\Admin\Resources\ServiceResource\Pages;

use Modules\Services\Filament\Admin\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;
}
