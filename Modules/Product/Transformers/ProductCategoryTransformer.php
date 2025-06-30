<?php

namespace Modules\Product\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Core\Transformers\JsonTransformer;

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
            'company_id' => $this->company_id,
            'parent' => $this->whenLoaded('parent', fn() => new ProductCategoryTransformer($this->parent)),
            'children' => $this->whenLoaded('children', fn() => ProductCategoryTransformer::collection($this->children)),
            'company' => $this->whenLoaded('company', fn() => new \Modules\Company\Transformers\CompanyTransformer($this->company)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ProductCategoryTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('name')->required(),
                Schema::string('description')->nullable(),
                Schema::integer('order')->nullable(),
                Schema::integer('parent_id')->nullable(),
                Schema::integer('company_id')->required(),
                Schema::ref('#/components/schemas/ProductCategoryTransformer', 'parent')->nullable(),
                Schema::array('children')->items(
                    Schema::ref('#/components/schemas/ProductCategoryTransformer')
                )->nullable(),
                Schema::ref('#/components/schemas/CompanyTransformer', 'company')->nullable(),
                Schema::string('created_at')->required(),
                Schema::string('updated_at')->required(),
            );
    }
} 