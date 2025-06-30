<?php

namespace Modules\Vehicle\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class VehicleCapacityWeightTransformer extends JsonTransformer
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
            'value' => $this->value,
            'unit' => $this->unit,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('VehicleCapacityWeightTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::integer('value')->required(),
                Schema::string('unit')->required(),
            );
    }
}
