<?php

namespace Modules\Rating\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class RatingTransformer extends JsonTransformer
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray(\Illuminate\Http\Request $request)
    {
        return parent::toArray($request);
    }

    public function schema(): Schema
    {
        return Schema::object('RatingTransformer')
            ->properties(
                Schema::string('name')->required(),
                Schema::integer('count')->required(),
                Schema::integer('score')->required(),
            );
    }
}
