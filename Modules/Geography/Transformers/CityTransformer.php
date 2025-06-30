<?php

namespace Modules\Geography\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class CityTransformer extends JsonTransformer
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
        return Schema::object('CityTransformer')
            ->properties(
                Schema::integer('id')->required()->example(1),
                Schema::string('name')->required(),
            );
    }
}
