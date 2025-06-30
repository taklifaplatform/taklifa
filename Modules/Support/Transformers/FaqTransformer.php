<?php

namespace Modules\Support\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

class FaqTransformer extends JsonTransformer
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
            'title' => $this->title,
            'content' => $this->content,
            'order' => $this->order,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('FaqTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('title')->required(),
                Schema::string('content')->required(),
                Schema::string('order')->required(),
            );
    }
}
