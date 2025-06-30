<?php

namespace Modules\Geography\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class LiveLocationTransformer extends JsonTransformer
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
            'latitude' => (float) $this->latitude,
            'longitude' => (float) $this->longitude,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('LiveLocationTransformer')
            ->properties(
                Schema::number('latitude')->required(),
                Schema::number('longitude')->example('3.3792057'),
            );
    }
}
