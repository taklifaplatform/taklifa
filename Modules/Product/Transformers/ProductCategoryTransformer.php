<?php

namespace Modules\Product\Transformers;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Modules\Company\Entities\Company;
use Modules\Company\Transformers\CompanyTransformer;
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
            'parent' => $this->whenLoaded('parent', fn() => new ProductCategoryTransformer($this->parent)),
            'company_id' => $this->company_id,
            'company' => $this->whenLoaded('company', fn() => new CompanyTransformer($this->company)),
            'children' => $this->whenLoaded('children', fn() => ProductCategoryTransformer::collection($this->children)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ProductCategoryTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('name')->required(),
                Schema::string('description')->nullable(),
                Schema::integer('order')->nullable(),
                Schema::string('parent_id')->nullable(),
                Schema::ref('#/components/schemas/ProductCategoryTransformer', 'parent')->nullable(),
                Schema::string('company_id')->required(),
                Schema::ref('#/components/schemas/CompanyTransformer', 'company'),
                Schema::array('children')->items(Schema::ref('#/components/schemas/ProductCategoryTransformer')),
                Schema::string('created_at')->nullable(),
                Schema::string('updated_at')->nullable(),
            );
    }
}