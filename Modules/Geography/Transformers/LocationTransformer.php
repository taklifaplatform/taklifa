<?php

namespace Modules\Geography\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class LocationTransformer extends JsonTransformer
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
            'owner_id' => $this->locationable_id,
            'latitude' => (float) $this->latitude,
            'longitude' => (float) $this->longitude,
            'address' => $this->address,
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'is_primary' => (bool) $this->is_primary,
            'building_name' => $this->building_name,
            'floor_number' => $this->floor_number,
            'house_number' => $this->house_number,
            'notes' => $this->notes,

            'city' => new CityTransformer($this->city),
            'city_id' => $this->city_id,
            'state' => new StateTransformer($this->state),
            'state_id' => $this->state_id,
            'country' => new CountryTransformer($this->country),
            'country_id' => $this->country_id,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('LocationTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('owner_id')->required(),
                Schema::number('latitude')->required(),
                Schema::number('longitude')->example('3.3792057'),
                Schema::string('address')->example('No 1, Lagos Street, Lagos'),
                Schema::string('phone_number'),
                Schema::string('name'),
                Schema::boolean('is_primary'),
                Schema::string('building_name'),
                Schema::string('floor_number'),
                Schema::string('house_number'),

                Schema::integer('city_id')->required(),
                Schema::integer('state_id')->required(),
                Schema::integer('country_id')->required(),

                Schema::string('notes')->nullable(),
                Schema::ref('#/components/schemas/CityTransformer', 'city'),
                Schema::ref('#/components/schemas/StateTransformer', 'state'),
                Schema::ref('#/components/schemas/CountryTransformer', 'country'),
            );
    }
}
