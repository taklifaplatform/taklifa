<?php

namespace Modules\Chat\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class ChatAppTransformer extends JsonTransformer
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function schema(): Schema
    {
        return Schema::object('ChatAppTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('propName')->required(),
            );
    }
}
