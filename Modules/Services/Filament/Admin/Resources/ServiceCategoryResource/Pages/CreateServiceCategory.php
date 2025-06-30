<?php

namespace Modules\Services\Filament\Admin\Resources\ServiceCategoryResource\Pages;

use Modules\Services\Filament\Admin\Resources\ServiceCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceCategory extends CreateRecord
{
    protected static string $resource = ServiceCategoryResource::class;
}
