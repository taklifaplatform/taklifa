<?php

namespace App\Filament;

use Filament\Facades\Filament;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getHeading(): string
    {
        $record = Filament::auth()->user();

        return (__('Welcome back')) . ', ' . $record->name;
    }

}
