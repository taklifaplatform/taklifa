<?php

namespace Modules\Chat\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class AttachmentTransformer extends JsonTransformer
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
            ...((array) $this->custom_properties),
            'id' => $this->id,
            'type' => 'image',
            'image_url' => $this->getUrl(),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('AttachmentTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('image_url')->required(),
            );
    }
}
