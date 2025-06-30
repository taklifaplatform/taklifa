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
            'company_id' => $this->company_id,
            'company' => $this->whenLoaded('company', fn() => new CompanyTransformer($this->company)),
            'category_id' => $this->category_id,
            'category' => $this->whenLoaded('category', fn() => new ProductCategoryTransformer($this->category)),
            'variants' => $this->whenLoaded('variants', fn() => ProductVariantTransformer::collection($this->variants)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ProductTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('name')->required(),
                Schema::string('description')->nullable(),
                Schema::string('company_id')->required(),
                Schema::ref('#/components/schemas/CompanyTransformer', 'company'),
                Schema::string('category_id')->nullable(),
                Schema::ref('#/components/schemas/ProductCategoryTransformer', 'category'),
                Schema::array('variants')
                    ->items(Schema::ref('#/components/schemas/ProductVariantTransformer'))
                    ->nullable(),
                Schema::string('created_at')->nullable(),
                Schema::string('updated_at')->nullable(),
            );
    }
}