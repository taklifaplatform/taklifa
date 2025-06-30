<?php

namespace Modules\Announcements\Filament\Admin\Resources\AnnouncementResource\Pages;

use Modules\Announcements\Filament\Admin\Resources\AnnouncementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAnnouncement extends CreateRecord
{
    protected static string $resource = AnnouncementResource::class;
}
