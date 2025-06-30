<?php

namespace Modules\Chat\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class SimpleChannelTransformer extends JsonTransformer
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
        return Schema::object('SimpleChannelTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::array('own_capabilities')->items(Schema::string()),
            );
    }
}
