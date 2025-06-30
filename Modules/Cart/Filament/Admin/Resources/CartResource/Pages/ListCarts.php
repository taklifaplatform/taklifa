<?php

namespace Modules\Cart\Filament\Admin\Resources\CartResource\Pages;

use Modules\Cart\Filament\Admin\Resources\CartResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCarts extends ListRecords
{
    protected static string $resource = CartResource::class;
}
