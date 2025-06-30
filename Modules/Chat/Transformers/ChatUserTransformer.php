<?php

namespace Modules\Chat\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;
use Modules\Core\Transformers\MediaTransformer;

class ChatUserTransformer extends JsonTransformer
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
            ...parent::toArray($request),
            'name' => $this->name ?? $this->username,
            'image' => $this->getFirstMedia('avatar')?->getUrl(),
            'avatar' => MediaTransformer::make($this->getFirstMedia('avatar')),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ChatUserTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('propName')->required(),
            );
    }
}
