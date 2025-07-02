<?php

namespace Modules\Cart\Filament\Admin\Resources\CartResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\Cart\Filament\Admin\Resources\CartResource;

class ListCarts extends ListRecords
{
    protected static string $resource = CartResource::class;
}
