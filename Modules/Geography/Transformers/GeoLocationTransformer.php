<?php

namespace Modules\Geography\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class GeoLocationTransformer extends JsonTransformer
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'address' => $this->address,
            'latitude' => (float) $this->latitude,
            'longitude' => (float) $this->longitude,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('GeoLocationTransformer')
            ->properties(
                Schema::string('address')->required()->example('Street 1, 08000 Barcelona'),
                Schema::number('latitude')->required()->example('43.3792057'),
                Schema::number('longitude')->required()->example('3.3792057'),
            );
    }
}
