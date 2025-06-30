<?php

namespace Modules\ServiceZone\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class ServiceZoneTransformer extends JsonTransformer
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
            'name' => $this->name,

            'areas' => ServiceAreaTransformer::collection($this->serviceArea),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ServiceZoneTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('name')->required(),

                Schema::array('areas')->items(
                    Schema::ref('#/components/schemas/ServiceAreaTransformer'),
                ),
            );
    }
}
