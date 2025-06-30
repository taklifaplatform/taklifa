<?php

namespace Modules\ServiceZone\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class ServiceAreaTransformer extends JsonTransformer
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
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ServiceAreaTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('name')->required(),
            );
    }
}
