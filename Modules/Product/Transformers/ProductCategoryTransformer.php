<?php

namespace Modules\Product\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class ProductCategoryTransformer extends JsonTransformer
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
            'description' => $this->description,
            'order' => $this->order,
            'parent_id' => $this->parent_id,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ProductCategoryTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('name')->required(),
                Schema::string('description')->nullable(),
                Schema::integer('order')->default(0),
                Schema::string('parent_id')->nullable()
            );
    }
}
