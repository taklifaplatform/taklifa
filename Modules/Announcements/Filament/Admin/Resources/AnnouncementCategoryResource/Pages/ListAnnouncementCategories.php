<?php

namespace Modules\Announcements\Filament\Admin\Resources\AnnouncementCategoryResource\Pages;

use Modules\Announcements\Filament\Admin\Resources\AnnouncementCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAnnouncementCategories extends ListRecords
{
    protected static string $resource = AnnouncementCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
