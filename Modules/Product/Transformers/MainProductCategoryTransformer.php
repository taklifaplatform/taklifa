<?php

namespace Modules\Product\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class MainProductCategoryTransformer extends JsonTransformer
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
            'sub_categories' => $this->when(isset($this->children) && $this->children->isNotEmpty(), function() {
                return $this->children->map(function($child) {
                    return [
                        'id' => $child->id,
                        'name' => $child->name,
                        'description' => $child->description,
                        'order' => $child->order,
                        'parent_id' => $child->parent_id,
                    ];
                });
            }),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('MainProductCategoryTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('name')->required(),
                Schema::string('description')->nullable(),
                Schema::integer('order')->default(0),
                Schema::string('parent_id')->nullable(),
                Schema::array('sub_categories')->items(
                    Schema::object()->properties(
                        Schema::string('id')->required(),
                        Schema::string('name')->required(),
                        Schema::string('description')->nullable(),
                        Schema::integer('order')->default(0),
                        Schema::string('parent_id')->required()
                    )
                )->nullable()
            );
    }
}
