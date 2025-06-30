<?php

namespace Modules\Rating\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class RatingTypeTransformer extends JsonTransformer
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
        return Schema::object('RatingTypeTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('name')->required(),
            );
    }
}
