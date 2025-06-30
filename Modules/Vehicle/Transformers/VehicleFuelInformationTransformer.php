<?php

namespace Modules\Vehicle\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class VehicleFuelInformationTransformer extends JsonTransformer
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
            'fuel_type' => $this->fuel_type,
            'fuel_capacity' => $this->fuel_capacity,
            'liter_per_km_in_city' => $this->liter_per_km_in_city,
            'liter_per_km_in_highway' => $this->liter_per_km_in_highway,
            'liter_per_km_mixed' => $this->liter_per_km_mixed,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('VehicleFuelInformationTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('fuel_type')->required(),
                Schema::integer('fuel_capacity')->required(),
                Schema::integer('liter_per_km_in_city')->required(),
                Schema::integer('liter_per_km_in_highway')->required(),
                Schema::integer('liter_per_km_mixed')->required(),
            );
    }
}
