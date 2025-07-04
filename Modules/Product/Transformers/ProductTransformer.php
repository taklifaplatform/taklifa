<?php

namespace Modules\Product\Transformers;

use Modules\Core\Transformers\JsonTransformer;
use Modules\Company\Transformers\CompanyTransformer;
use Modules\Product\Transformers\ProductCategoryTransformer;
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
            'company' => CompanyTransformer::make($this->company),
            'category' =>ProductCategoryTransformer::make($this->category),
            'variants' => ProductVariantTransformer::collection($this->whenLoaded('variants')),
        ];
    }

    public function schema(): Schema
    {
        return Schema::object('ProductTransformer')
            ->properties(
                Schema::string('id')->required(),
                Schema::string('name')->required(),
                Schema::string('description')->nullable(),
                Schema::ref('#/components/schemas/CompanyTransformer', 'company'),
                Schema::ref('#/components/schemas/ProductCategoryTransformer', 'category'),
                Schema::array('variants')
                    ->items(Schema::ref('#/components/schemas/ProductVariantTransformer'))
                    ->nullable(),
            );
    }
}