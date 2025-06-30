<?php

namespace Modules\Core\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class MediaTransformer extends JsonTransformer
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
            'uuid' => null,
            'url' => $this->getUrl('preview'),
            'original_url' => $this->getUrl(),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('MediaTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('uuid')->required(),
                Schema::string('url')->required(),
                Schema::string('original_url')->required(),
            );
    }
}
