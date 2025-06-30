<?php

namespace Modules\Vehicle\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class VehicleInformationTransformer extends JsonTransformer
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
            'body_type' => $this->body_type,
            'steering_wheel' => $this->steering_wheel, // 'right' or 'left
            'top_speed' => $this->top_speed,
            'doors_count' => $this->doors_count,
            'seats_count' => $this->seats_count,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('VehicleInformationTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('body_type')->required(),
                Schema::string('steering_wheel')->required(),
                Schema::integer('top_speed')->required(),
                Schema::integer('doors_count')->required(),
                Schema::integer('seats_count')->required(),
            );
    }
}
