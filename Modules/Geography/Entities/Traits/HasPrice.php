<?php

namespace Modules\Geography\Entities\Traits;

use Modules\Geography\Entities\Price;

trait HasPrice
{
    public function prices()
    {
        return $this->morphMany(Price::class, 'priceable');
    }
}
