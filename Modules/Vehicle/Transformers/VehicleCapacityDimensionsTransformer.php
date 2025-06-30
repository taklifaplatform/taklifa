<?php

namespace Modules\Vehicle\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class VehicleCapacityDimensionsTransformer extends JsonTransformer
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
            'id' => $this->id,
            'width' => $this->width,
            'height' => $this->height,
            'length' => $this->length,
            'unit' => $this->unit,
        ];

    }

    public function schema(): Schema
    {
        return Schema::object('VehicleCapacityDimensionsTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::integer('width')->required(),
                Schema::integer('height')->required(),
                Schema::integer('length')->required(),
                Schema::string('unit')->required(),
            );
    }
}
