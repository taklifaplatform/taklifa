<?php

namespace Modules\Product\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use Modules\Company\Transformers\CompanyTransformer;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class ProductTransformer extends JsonTransformer
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
            'company_id' => CompanyTransformer::make($this->company),
            'category_id' => ProductCategoryTransformer::make($this->category),

            // 'parent_id' => $this->parent_id,
            // 'parent' => $this->whenLoaded('parent', fn() => new ProductCategoryTransformer($this->parent)),
            // 'company_id' => $this->company_id,
            // 'company' => $this->whenLoaded('company', fn() => new CompanyTransformer($this->company)),
            // 'children' => $this->whenLoaded('children', fn() => ProductCategoryTransformer::collection($this->children)),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ProductTransformer')
            ->properties(
                Schema::integer('id')->required(),
                Schema::string('name')->required(),
                Schema::string('description')->nullable(),
                Schema::integer('company_id')->required(),
                Schema::integer('category_id')->nullable(),
                Schema::ref('#/components/schemas/CompanyTransformer', 'company'),
                Schema::ref('#/components/schemas/ProductCategoryTransformer', 'category')
            );
    }
}