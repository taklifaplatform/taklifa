<?php

namespace Modules\Announcements\Filament\Admin\Resources\AnnouncementCategoryResource\Pages;

use Modules\Announcements\Filament\Admin\Resources\AnnouncementCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnnouncementCategory extends CreateRecord
{
    protected static string $resource = AnnouncementCategoryResource::class;
}
