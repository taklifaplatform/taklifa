<?php

namespace Modules\Notification\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class NotificationStatusTransformer extends JsonTransformer
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
        return Schema::object('NotificationStatusTransformer')
            ->properties(
                Schema::integer('count')->required(),
            );
    }
}
